@extends('layouts.admin')

@section('content')

    <div class="comments-block">
        <h3>Comments that user</h3>

        @foreach($comments as $comment)
            <div class="comment-item">
                <a href="/product/{{ $comment->product->id }}">Go to the product</a>
                <div class="comment-id hidden">{{ $comment->id }}</div>
                <div class="comment-name">User name: {{ $comment->user->name }}</div>
                <div class="comment-product">Product name: {{ $comment->product->name }}</div>
                <div class="comment-create">Comment created: {{ $comment->created_at }}</div>
                <div class="comment-update">Comment updated{{ $comment->updated_at }}</div>
                <div class="comment-text">{{ $comment->text }}</div>
            </div>
        @endforeach

    </div>

@endsection