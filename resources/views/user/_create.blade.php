<div class="create-user-field">
    {{ Form::label('name', 'Name:') }}
    {{ Form::text('name', null, ['class' => 'form-control']) }}
    {{ Form::label('email', 'Email:') }}
    {{ Form::text('email', null, ['class' => 'form-control']) }}
    {{ Form::label('password', 'Password:') }}
    {{ Form::text('password', '', ['class' => 'form-control']) }}
    {{ Form::label('password_confirmation', 'Password confir:') }}
    {{ Form::text('password_confirmation', null, ['class' => 'form-control']) }}
    {{ Form::label('isAdmin', 'Admin:') }}
    <input type="hidden" name="isAdmin" value="0">
    <input type="checkbox" name="isAdmin" value="1">
    {{ Form::label('seen', 'Seen:') }}
    <input type="hidden" name="seen" value="0">
    <input type="checkbox" name="seen" value="1">
    <br>
    {{ Form::submit($createButtonText, ['class' => 'btn btn-primary']) }}
</div>