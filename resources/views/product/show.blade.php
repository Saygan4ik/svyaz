@extends('layouts/app')

@section('content')

    <div class="product-item">
        <p>Model: {{ $product->name }}</p>
        <p>Price: {{ $product->price }}</p>
        @if($product->discount)
            <p>Discount!!! {{ $product->discount }}</p>
            <p>Total price: {{ $product->total_price }}</p>
        @endif
    </div>

@endsection

@section('comment')

    @can('create', \App\Comment::class)
        <button class="comment-create" id="comment_create">Add Comment</button>
        <div class="comment-new-field hidden">
            {{ Form::open(['method' => 'POST', 'action' => ['CommentController@store']]) }}
            {{ Form::hidden('product_id', $product->id) }}
            {{ Form::textarea('text', null, ['class' => 'form-control']) }}
            {{ Form::submit('Create', ['class' => 'btn btn-primary comment-btn']) }}
            {{ Form::close() }}
        </div>
    @endcan

    @foreach($comments as $comment)

        <div class="comment-item">
            @can('update', $comment)
                <button type="submit" class="comment-edit">[EDIT]</button>
                {{ Form::model($comment, ['method' => 'DELETE', 'action' => ['CommentController@destroy', $comment->id]]) }}
                <button type="submit" class="comment-delete">[DEL]</button>
                {{ Form::close() }}
            @endcan
            <div class="comment-user">{{ $comment->user->name }}</div>
            <div class="comment-date-created">Comment created: {{ $comment->created_at }}</div>
            <div class="comment-date-updated">Last updated: {{ $comment->updated_at }}</div>
            <div class="comment-text" id="comment_text">{{ $comment->text }}</div>
            @can('update', $comment)
                <div id="comment_text_edit" class="comment-text-edit hidden">
                    {{ Form::model($comment, ['method' => 'PATCH', 'action' => ['CommentController@update', $comment->id]]) }}
                    {{ Form::hidden('product_id', $product->id) }}
                    {{ Form::textarea('text', null, ['class' => 'form-control']) }}
                    {{ Form::submit('Edit', ['class' => 'btn btn-primary comment-btn']) }}
                    {{ Form::close() }}
                </div>
            @endcan
        </div>

    @endforeach

@endsection

@section('script')

    <script>
        $(document).ready(function() {
            $('#comment_create').click(function() {
                $('.comment-new-field').toggleClass('hidden');
            });
            $('.comment-edit').click(function() {
                var comment = $(this).parent();
                var textComment = comment.children('#comment_text').text();
                comment.children('#comment_text').toggleClass('hidden');
                comment.children('#comment_text_edit').toggleClass('hidden');
            })
        });
    </script>

@endsection