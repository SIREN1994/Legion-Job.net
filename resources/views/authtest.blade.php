@extends('layout')

@section('content')
    <div class="container">
        @if (auth()->check())
            <h1>Welcome, {{ auth()->user()->name }}</h1>
            <p>You are currently logged in.</p>
        @else
            <h1>Unauthenticated User</h1>
            <p>You are not logged in.</p>
        @endif
    </div>
@endsection
