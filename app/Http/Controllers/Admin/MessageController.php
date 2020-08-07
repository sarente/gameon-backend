<?php

namespace App\Http\Controllers\Admin;

use App\Models\Message;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    protected $transPrefix = 'models.message.';

    public function index()
    {
        $messages = Message::all();

        return view('admin.messages.index', compact('messages'))->with('transPrefix', $this->transPrefix);
    }

    public function create()
    {
        $types= trans($this->transPrefix . 'types');
        $statuses = trans($this->transPrefix . 'statuses');
        $screens = trans($this->transPrefix . 'screens');
        $actions = trans($this->transPrefix . 'actions');

        return view('admin.messages.create')->with([
            'transPrefix'=> $this->transPrefix,
            'types' => $types,
            'statuses' => $statuses,
            'screens' => $screens,
            'actions' => $actions,
            'selected_type' => "",
            'selected_status' => "",
            'selected_screen' => "",
            'selected_action' => ""
        ]);
    }

    public function store(Request $request)
    {
        $message = new Message($request->all());
        $message->save();

        return redirect('admin/message')->with('flash_message', 'Message added!');
    }

    public function show($id)
    {
        $message = Message::findOrFail($id);

        return view('admin.messages.show', compact('message'))->with('transPrefix', $this->transPrefix);
    }

    public function edit($id)
    {
        $message = Message::findOrFail($id);

        $types= trans($this->transPrefix . 'types');
        $statuses = trans($this->transPrefix . 'statuses');
        $screens = trans($this->transPrefix . 'screens');
        $actions = trans($this->transPrefix . 'actions');

        return view('admin.messages.edit', compact('message'))->with([
            'transPrefix'=> $this->transPrefix,
            'types' => $types,
            'statuses' => $statuses,
            'screens' => $screens,
            'actions' => $actions,
            'selected_type' => $message->type,
            'selected_status' => $message->status,
            'selected_screen' => $message->screen,
            'selected_action' => $message->action
        ]);
    }

    public function update()
    {

    }

    public function destroy($id)
    {
        Message::destroy($id);

        return redirect('admin/message')->with('flash_message', 'Message deleted!');
    }
}
