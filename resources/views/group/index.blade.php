@extends('layouts.admin')

@section('content')

    <h3 style="color: white">Editing groups</h3>
    <button id="create_group_button" class="btn btn-primary">Create a new group</button>
    <div id="create_group_field" class="group-item hidden">
        <h3>Create a new group</h3>
        {{ Form::open(['method' => 'POST', 'action' => 'GroupController@store']) }}
        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter name']) }}
        {{ Form::text('nameRU', null, ['class' => 'form-control', 'placeholder' => 'Enter nameRU']) }}
        {{ Form::submit('Create group', ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}
    </div>

    @foreach($groups as $group)

        <div class="group-item">
            {{ Form::model($group, ['method' => 'PATCH', 'action' => ['GroupController@update', $group->id]]) }}
            {{ Form::text('name', $group->name, ['class' => 'form-control']) }}
            {{ Form::text('nameRU', $group->nameRU, ['class' => 'form-control']) }}
            {{ Form::submit('Edit group', ['class' => 'btn btn-primary']) }}
            {{ Form::close() }}
            {{ Form::model($group, ['method' => 'DELETE', 'action' => ['GroupController@destroy', $group->id]]) }}
            {{ Form::submit('Delete group', ['class' => 'btn btn-warning', 'id' => 'delete_group_button']) }}
            {{ Form::close() }}
        </div>

    @endforeach

@endsection

@section('script')

    <script>
        $(document).ready(function() {
            $('#create_group_button').click(function() {
                $('#create_group_field').toggleClass('hidden');
            });
        });
    </script>

@endsection

