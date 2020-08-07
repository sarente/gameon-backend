<?php

namespace App\Http\Controllers\Admin;

use App\Models\Answer;
use App\Models\Image;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;

class QuestionController extends Controller
{
    protected $transPrefix = 'models.question.';

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 15;

        if (!empty($keyword)) {
            $questions = Question::where('question_text', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $questions = Question::orderBy('id', 'ASC')->paginate($perPage);
        }

        return view('admin.questions.index', compact('questions'))->with('transPrefix', $this->transPrefix);
    }

    public function create()
    {
        return view('admin.questions.create')->with([
            'transPrefix'=> $this->transPrefix,
            'question_text' => "",
            'answers' => "",
            'num_of_answers' => 0
            ]);
    }

    public function store(Request $request)
    {
        $user = $request->user();

        $question = new Question($request->input());
        $question->user()->associate($user);
        $question->save();

        if ($request->answer_text){
            $answers = explode(',', $request->answer_text);
            $answer_statuses = explode(',', $request->right_answer);

            foreach ($answers as $index => $answer){
                $question->answers()->save(new Answer([
                    'answer_text' => $answer,
                    'right_answer' => $answer_statuses[$index]
                ]));
            }
        }

        if ($request->hasFile('image')) {
            $question->image()->save(new Image([
                'image' => $request->file('image'),
            ]));
        }
        if ($request->input('image_url')) {
            $question->image()->save(new Image([
                'image' => ImageManager::make($request->input('image_url')),
            ]));
        }

        return redirect('admin/question')->with('flash_message', 'Question added!');
    }

    public function show($id)
    {
        $question = Question::find($id);

        $question->load('image', 'answers');

        return view('admin.questions.show', compact('question'))->with([
            'transPrefix'=> $this->transPrefix,
        ]);
    }

    public function edit($id)
    {
        $question = Question::find($id);
        if(!$question){
            return response()->error('question.not-found');
        }

        return view('admin.questions.edit', compact('question'))->with([
            'transPrefix'=> $this->transPrefix,
            'question_text' => $question->question_text,
            'answers' => $question->answers->toArray(),
            'num_of_answers' => $question->answers->count()
        ]);
    }

    public function update(Request $request, $id)
    {
        $question = Question::find($id);
        if(!$question){
            return response()->error('question.not-found');
        }

        if ($request->hasFile('image')) {
            $question->image()->delete();
            $question->image()->save(new Image([
                'image' => $request->file('image'),
            ]));
        }
        if ($request->input('image_url')) {
            $question->image()->save(new Image([
                'image' => ImageManager::make($request->input('image_url')),
            ]));
        }

        if ($request->answer_text){
            $question->answers()->delete();

            $answers = explode(',', $request->answer_text);
            $answer_statuses = explode(',', $request->right_answer);

            foreach ($answers as $index => $answer){
                $question->answers()->save(new Answer([
                    'answer_text' => $answer,
                    'right_answer' => $answer_statuses[$index]
                ]));
            }
        }

        return redirect('admin/question')->with('flash_message', 'Question updated!');
    }

    public function destroy($id)
    {
        Question::destroy($id);

        return redirect('admin/question')->with('flash_message', 'Question deleted!');
    }
}
