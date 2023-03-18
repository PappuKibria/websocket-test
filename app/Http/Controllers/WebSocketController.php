<?php

namespace App\Http\Controllers;


use App\Events\SendMessage;
use Illuminate\Http\Request;

class WebSocketController extends \Illuminate\Routing\Controller
{
    public function showForm(){
        return view('echoForm');
    }
    public function showMessage(Request $request){
        SendMessage::broadcastWith($request);
    }
}
