<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Event;

class EventsController extends Controller
{
    public function getList() {
        $events = Event::withCount('users')->get();
        return view('events.list')->withEvents($events);
    }

    public function getSingle(Event $event) {
        dd($event->users()->get());
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

        $error = null;
        //TODO: validation

        //Check if event exists
        $event = Event::whereCode($request->input('code'))->first();
        $user = \Auth::user();

        if( is_null($event) || ! $event->exists() ) {
            $error = __('No event for the code found');
        } else if ($user->events()->where('event_id', $event->id)->exists()) {
            //Check if already joined
            $error = __('Already joined event');
        }
//        else if (Carbon::now()->between(
//            Carbon::parse($event->startTime)->subMinutes(20),
//            Carbon::parse($event->startTime)->addMinutes($event->duration + 10)
//        )){
            //Check if event is happening now
//            dd(Carbon::parse(Carbon::parse($event->startTime)->addMinutes($event->duration + 10)));
            $error = __('Event has not yet started, or has ended');
//        }

        if( ! is_null($error) ) {
            return redirect()->back()->withErrors([$error]);
        } else {
            //Add user to event
            $user->events()->attach($event);
            return redirect()->route('events.attended')->withMessage('Event joined');
        }

    }
}
