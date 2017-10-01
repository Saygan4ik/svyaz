@extends('layouts.admin')

@section('content')

    <div class="users-block">
        <h3>Users</h3>
        <a href="/user/create" class="btn btn-primary">Create a new user</a><br>
        <a href="/user">all</a>
        <a href="/user_new">new</a>
        <a href="/user_admin">admins</a>
        @foreach($users as $user)

            <div class="user-item">
                <div class="user-id hidden">{{ $user->id }}</div>
                <div class="user-name">{{ $user->name }}</div>
                <div class="user-email">{{ $user->email }}</div>
                <div class="user-button">
                    <div class="user-seen-{{ $user->seen }} user-seen-button user-seen-button-{{ $user->id }}">
                        {{ Form::submit('Seen', ['class' => 'btn']) }}
                    </div>
                    <div class="user-seen-{{ $user->isAdmin }} user-admin-button user-admin-button-{{ $user->id }}">
                        {{ Form::submit('Admin', ['class' => 'btn']) }}
                    </div>
                    {{ Form::model($user, ['method' => 'GET', 'action' => ['UserController@edit', $user->id]]) }}
                    {{ Form::submit('Edit', ['class' => 'btn', 'style' => 'background-color: yellow']) }}
                    {{ Form::close() }}
                    {{ Form::model($user, ['method' => 'DELETE', 'action' => ['UserController@destroy', $user->id]]) }}
                    {{ Form::submit('Delete', ['class' => 'btn', 'style' => 'background-color: red']) }}
                    {{ Form::close() }}
                </div>
            </div>

        @endforeach

        {{ $users->links() }}
    </div>

@endsection

@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $('.user-seen-button').children('.btn').click(function(e) {
                e.preventDefault();
                var id = $(this).parent().parent().parent().children('.user-id').text();
                $.ajax({
                    url: 'user/ajaxChangeSeen',
                    type: 'POST',
                    data: {id : id },
                    dataType: 'json',
                    success: function(data) {
                        if($('.user-seen-button-' + data).hasClass('user-seen-1')) {
                            $('.user-seen-button-' + data).removeClass('user-seen-1');
                            $('.user-seen-button-' + data).addClass('user-seen-0');
                        }
                        else {
                            $('.user-seen-button-' + data).removeClass('user-seen-0');
                            $('.user-seen-button-' + data).addClass('user-seen-1');
                        }
                    }
                });
            });
            $('.user-admin-button').children('.btn').click(function(e) {
                e.preventDefault();
                var id = $(this).parent().parent().parent().children('.user-id').text();
                $.ajax({
                    url: 'user/ajaxChangeAdmin',
                    type: 'POST',
                    data: {id : id },
                    dataType: 'json',
                    success: function(data) {
                        if($('.user-admin-button-' + data).hasClass('user-seen-1')) {
                            $('.user-admin-button-' + data).removeClass('user-seen-1');
                            $('.user-admin-button-' + data).addClass('user-seen-0');
                        }
                        else {
                            $('.user-admin-button-' + data).removeClass('user-seen-0');
                            $('.user-admin-button-' + data).addClass('user-seen-1');
                        }
                    }
                });
            });
        });
    </script>
@endsection