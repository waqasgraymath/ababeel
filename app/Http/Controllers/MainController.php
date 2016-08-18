<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Log;
use App\MessageRelay;
use App\Topic;
use App\User;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{

    public function add_on_demand(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'join_code' => 'required|max:255'
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
    public function add_api_on_demand(Request $request)
    {
        $this->validate($request, [
            'your_system_id' => 'required|max:255',
            'title' => 'required|max:255',
            'short_message' => 'required',
            'long_message' => 'required',
            'action_url' => 'required'
        ]);

        $relay = new MessageRelay;
        $relay->topic_id = $request->topic_id;
        $relay->title = $request->title;
        $relay->short_message = $request->short_message;
        $relay->long_message = $request->long_message;
        $relay->action_url = $request->action_url;
        $relay->your_system_id = $request->your_system_id;
        $relay->end_point = $request->end_point;
        $relay->secret = $request->secret;

        $relay->save();

        return redirect()->route('dashboard');
    }

    public function add_not_pinged(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'join_code' => 'required|max:255',
            'occurance' => 'required',
            'intervals' => 'required'
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
        
//        $topics = Topic::all();
        $topics = DB::table('topics')->get();
        
        return view('dashboard', ['topics' => $topics, 'topic_id'=> 0]);
    }

    public function topic_detail($topic_id)
    {
        $topic_details = MessageRelay::where('topic_id', $topic_id)->take(10)->get();
        $topics = Topic::all();

        return view('dashboard', ['topics' => $topics, 'details' => $topic_details,
                'topic_id'=> $topic_id ]);
    }
    public function api($topic_id)
    {
        return view('api_on_demand', ['topic_id' => $topic_id ]);
    }

}
