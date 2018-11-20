<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use App\User;
use Illuminate\Http\Request;
use App\Event;

class EventsController extends Controller
{
    public function getList() {
        $events = Event::withCount('users');
        return view('events.list')->withEvents($events);
    }

    public function getUserList() {
        $events = \Auth::user()->events()->get();
        return view('events.list')->withEvents($events);
    }

    public function getAdd() {
        return view('events.add');
    }

    public function postAdd(Request $request) {
        //TODO: validate input

        $event = new Event();
        $event->name = $request->input('name');
        $event->location = $request->input('location');
        $event->startTime = $request->input('startTime');
        $event->duration = $request->input('duration');
        $event->code = str_random(8);
        $event->isPrivate = $request->has('isPrivate');

        $event->save();

        return redirect()->route('events.list');
    }

    public function getJoin() {
        return view('events.join');
    }

    public function postJoin(Request $request) {
        //TODO: validation

        //Check if event exists
        $event = Event::whereCode($request->input('code'))->first();

        if($event->exists()) {
            //Add user to event
            $user = \Auth::user();
            $user->events()->attach($event);
            return redirect()->route('events.list');
        } else {
            return redirect()->back();
        }

    }
}
