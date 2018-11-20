@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="post" action="{{ route('events.post.add') }}">
                    <label for="name">{{ __('Name') }}</label> <input type="text" name="name"><br>
                    <label for="name">{{ __('Location') }}</label><input type="text" name="location"><br>
                    <label for="name">{{ __('Start Time') }}</label><input type="datetime-local" name="startTime"><br>
                    <label for="name">{{ __('Duration') }}</label><input type="number" name="duration"><br>
                    <label for="name">{{ __('Is Private') }}</label><input type="checkbox" name="isPrivate"><br>
                    @csrf
                    <input type="submit">
                </form>
            </div>
        </div>
    </div>
@endsection