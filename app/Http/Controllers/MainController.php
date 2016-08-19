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

        return redirect()->route('dashboard', ['id' => $topic->id]);
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

        return redirect()->route('dashboard', ['id' => $request->topic_id]);
    }

    public function add_api_ping_check(Request $request)
    {

        $relay = new MessageRelay;
        $relay->topic_id = $request->topic_id;
        $relay->end_point = $request->end_point;
        $relay->secret = $request->secret;

        $relay->save();

        return redirect()->route('dashboard', ['id' => $request->topic_id]);
    }

    public function add_not_pinged(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'join_code' => 'required|max:255',
            'occurance' => 'required',
            'intervals' => 'required'
        ]);
        $topic = new Topic;
        $topic->title = $request->title;
        $topic->owner_id = 1; // THe id of the user who is logged in
        $topic->join_code = $request->join_code;
        $topic->relay = 'if not pinged';
        $topic->active = $request->active;
        $topic->email = $request->email;
        $topic->sms = $request->sms;
        $topic->pn = $request->pn;
        $topic->occurance = $request->occurance;
        $topic->intervals = $request->intervals;
        $topic->time_unit = $request->time_unit;

        $topic->save();

        return redirect()->route('dashboard', ['id' => $topic->id]);
    }

    public function dashboard($topic_id = 0)
    {

//        $topics = Topic::all();
        if ($topic_id != 0)
        {
            $topic_details = MessageRelay::where('topic_id', $topic_id)->take(10)->get();
            $topics = DB::table('topics')->get();

            return view('dashboard', ['topics' => $topics, 'details' => $topic_details,
                'topic_id' => $topic_id]);
        }
        else
        {
            $topics = DB::table('topics')->get();

            return view('dashboard', ['topics' => $topics, 'topic_id' => $topic_id]);
        }
    }

    public function topic_detail($topic_id)
    {
        $topic_details = MessageRelay::where('topic_id', $topic_id)->take(10)->get();
        $topics = Topic::all();

        return view('dashboard', ['topics' => $topics, 'details' => $topic_details,
            'topic_id' => $topic_id]);
    }

    public function execute_cron(Request $request)
    {
//        URL for cron
//        http://localhost/ababeel/public/execute_cron?r=22&t=1&s=25863&st=success&e=2016-08-19 08:03:01

        $message_relays = DB::table('message_relays')
                ->where('topic_id', $request->t)
                ->where('id', $request->r)
                ->where('secret', $request->s)
                ->get();

        if (empty($message_relays))
        {
            abort(403, 'Unauthorized action.');
        }
        else
        {
            $log = new Log;
            $log->topic_id = $request->t;
            $log->message_relay_id = $request->r;
            $log->executed_on = $request->e;
            $log->status = $request->st;
            $log->save();

            $topics = DB::table('topics')
                    ->where('id', $request->t)
                    ->where('active', 1)
                    ->get();

            if ($topics[0]->relay == 'on demand')
            {
                if ($topics[0]->active == 1)
                {
                    if ($topics[0]->email == 1)
                    {
//                    Send Email
                    }
                    if ($topics[0]->sms == 1)
                    {
//                    Send SMS                        
                    }
                    if ($topics[0]->pn == 1)
                    {
//                        SND PN push notification parse
                    }
                }
            }
            else
            {
//                First take the values from the occurances and intervals and check
//                How many times the cron has executed so far. 
//                And show the result.
            }
            print_r($topics[0]->relay);
        }


        exit;
    }

    public function api($topic_id, $relay)
    {
        if ($relay == 'on demand')
        {
            return view('api_on_demand', ['topic_id' => $topic_id]);
        }
        else if ($relay == 'if not pinged')
        {
            return view('api_ping_check', ['topic_id' => $topic_id]);
        }
        else if ($relay == 'default')
        {
            return redirect()->route('dashboard');
        }
    }

    public function log($topic_id, $relay_id)
    {
        $logs = DB::table('logs')
                ->where('topic_id', $topic_id)
                ->where('message_relay_id', $relay_id)
                ->get();
        
        $topic_details = MessageRelay::where('topic_id', $topic_id)->take(10)->get();
        $topics = DB::table('topics')->get();
        
        return view('dashboard', ['topics' => $topics, 'details' => $topic_details,
            'topic_id' => $topic_id, 'logs' => $logs]);
    }

}
