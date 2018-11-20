@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                    @unless($events->count())
                        No events.
                    @else
                    <table class="table">
                        <thead>
                        <td>{{ __('Name') }}</td>
                        <td>{{ __('Start time') }}</td>
                        <td>{{ __('Location') }}</td>
                        <td>{{ __('Code') }}</td>
                        <td>{{ __('Users') }}</td>
                        </thead>
                        @foreach($events as $event)
                            <tr>
                                <td>{{ $event->name }}</td>
                                <td>{{ $event->startTime }}</td>
                                <td>{{ $event->location }}</td>
                                <td>{{ $event->code }}</td>
                                <td>{{ $event->users_count }}</td>
                            </tr>
                        @endforeach
                    </table>
                    @endunless
            </div>
        </div>
    </div>
@endsection
