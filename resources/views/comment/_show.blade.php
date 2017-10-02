@foreach($comments as $comment)
    <div class="comment-item">
        <a href="/product/{{ $comment->product->id }}">Go to the product</a>
        <div class="comment-id hidden">{{ $comment->id }}</div>
        <div class="comment-name">User name: {{ $comment->user->name }}</div>
        <div class="comment-product">Product name: {{ $comment->product->name }}</div>
        <div class="comment-create">Comment created: {{ $comment->created_at }}</div>
        <div class="comment-update">Comment updated{{ $comment->updated_at }}</div>
        <div class="comment-text">{{ $comment->text }}</div>
        <div class="comment-button">
            <div class="comment-seen-{{ $comment->seen }} comment-seen-button comment-seen-button-{{ $comment->id }}">
                {{ Form::submit('Seen', ['class' => 'btn']) }}
            </div>
            {{ Form::model($comment, ['method' => 'DELETE', 'action' => ['CommentController@destroy', $comment->id]]) }}
            {{ Form::submit('Delete', ['class' => 'btn', 'style' => 'background-color: red']) }}
            {{ Form::close() }}
        </div>
    </div>
@endforeach