<?php

namespace App\Http\Controllers\Api;

use App\Models\Activity;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function store(Request $request, $id)
    {
        $activity = Activity::find($id);

        if (!$activity) {
            return response()->error('activity.not-found');
        }

        $post = new Post($request->input());
        $post->user()->associate(auth()->user());
        $activity->posts()->save($post);

        return response()->success('common.success');
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->error('post.not-found');
        }

        $post->fill([
            'text' => $request->text
        ]);
        $post->update();

        return response()->success('common.success');
    }

    public function destroy($id){
        $post = Activity::find($id);
        if (!$post) {
            return response()->error('post.not-found');
        }

        $post->delete();
        return response()->success('common.success');
    }
}
