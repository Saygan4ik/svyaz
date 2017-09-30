@extends('layouts.admin')

@section('content')

    <div class="admin-item">
        <h3>Groups: {{ $groups->count() }}</h3>
        @foreach($groups as $group)
            <span>{{ $group->nameRU }}</span>
        @endforeach
        <br>
        <a href="/group" class="btn btn-primary">Next</a>
    </div>

    <div class="admin-item">
        <h3>Product: {{ $products['total'] }}</h3>
        @foreach($groups as $group)
            <a href="/product_{{ $group->name }}">{{ $group->nameRU }}({{ $products[$group->id] }})</a>
        @endforeach
        <br>
        <a href="/product" class="btn btn-primary">Next</a>
    </div>

    <div class="admin-item">
        <h3>Users: {{ $users['total'] }}</h3>
        <span>new = {{ $users['total']-$users['seen'] }}</span>
        <span>admin(s) = {{ $users['admin'] }}</span>
        <br>
        <a href="#" class="btn btn-primary">Next</a>
    </div>

    <div class="admin-item">
        <h3>Comments: {{ $comments['total'] }}</h3>
        <span>new = {{ $comments['total']-$comments['seen'] }}</span>
        <br>
        <a href="#" class="btn btn-primary">Next</a>
    </div>

@endsection