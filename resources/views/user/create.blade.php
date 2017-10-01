@extends('layouts.admin')

@section('content')

    <div class="create-user-block">
        <h3>New User</h3>
        {{ Form::open(['method' => 'POST', 'action' => 'UserController@store']) }}
        @include('user._create', ['createButtonText' => 'Create a new user'])
        {{ Form::close() }}
    </div>

@endsection