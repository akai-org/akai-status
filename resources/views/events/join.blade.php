@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="post" action="{{ route('events.post.join') }}">
                    <label for="code">{{ __('Code') }}</label> <input type="text" name="code"><br>
                    @csrf
                    <input type="submit">
                </form>
            </div>
        </div>
    </div>
@endsection