@extends('layouts.admin')

@section('content')

    <div class="create-user-block">
        <h3>Edit User</h3>
        {{ Form::model($user, ['method' => 'PATCH', 'action' => ['UserController@update', $user->id]]) }}
        @include('user._create', ['createButtonText' => 'Edit a user'])
        {{ Form::close() }}
    </div>

@endsection