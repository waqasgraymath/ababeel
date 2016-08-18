<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Log;
use App\MessageRelay;
use App\Topic;
use App\User;

class MainController extends Controller
{

    public function add_on_demand(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'join_code' => 'required|max:255',
        ]);

        $topic = new Topic;
        $topic->title = $request->title;
        $topic->owner_id = 1; // THe id of the user who is logged in
        $topic->join_code = $request->join_code;
        $topic->relay = 'on demand';
        $topic->active = $request->active;
        $topic->email = $request->email;
        $topic->sms = $request->sms;
        $topic->pn = $request->pn;

        $topic->save();
        
        return redirect()->route('dashboard');
        
    }

    public function add_not_pinged(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'join_code' => 'required|max:255',
            'occurance' => 'required',
            'intervals' => 'required',
        ]);
        $request->title;
        $request->join_code;
        $request->occurance;
        $request->intervals;
        $request->active;
        $request->email;
        $request->sms;
        $request->pn;
        exit;
    }
    public function dashboard()
    {
        $topics = Topic::all();

        return view('dashboard', ['topics' => $topics]);
        
    }

}
