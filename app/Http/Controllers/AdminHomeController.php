<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminHomeController extends Controller
{
    public function Home()
    {
        return view('admin.home');
    }

    public function MessageList()
    {
        $Messages = Message::where('active', 1)->get();
        return view('admin.message.list', compact('Messages'));
    }

    public function MessageShow(Message $Message)
    {
        return view('admin.message.show', compact('Message'));
    }

    public function MessageActive(Message $Message)
    {
        $Message->active = !$Message->active;
        $Message->save();

        return redirect()->route('admin.message.list');
    }
}
