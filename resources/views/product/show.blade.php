@extends('layouts/app')

@section('content')

    <div class="product-item">
        <div class="productId hidden">{{ $product->id }}</div>
        <p>Model: {{ $product->name }}</p>
        <p>Price: {{ $product->price }}</p>
        @if($product->discount)
            <p>Discount!!! {{ $product->discount }}</p>
            <p>Total price: {{ $product->total_price }}</p>
        @endif
        <div class="rating">
            <div class="user-rating">
                <p>Your rating</p>
                <div class="case-rating">
                    @if(Auth::check())
                        <button class="case-rating-btn case-rating-1 @if($rating['rating'] >= 1) case-rating-green @else case-rating-grey @endif" value="1"></button>
                        <button class="case-rating-btn case-rating-2 @if($rating['rating'] >= 2) case-rating-green @else case-rating-grey @endif" value="2"></button>
                        <button class="case-rating-btn case-rating-3 @if($rating['rating'] >= 3) case-rating-green @else case-rating-grey @endif" value="3"></button>
                        <button class="case-rating-btn case-rating-4 @if($rating['rating'] >= 4) case-rating-green @else case-rating-grey @endif" value="4"></button>
                        <button class="case-rating-btn case-rating-5 @if($rating['rating'] >= 5) case-rating-green @else case-rating-grey @endif" value="5"></button>
                    @else
                        <p>Not auth</p>
                    @endif
                </div>
            </div>
            <div class="avg-rating">
                <p>avg</p>
                @if($product->sumRating)
                    <p>{{ $product->sumRating / $product->quantityRating }}</p>
                @else
                    <p>no ratings :(</p>
                @endif
            </div>
        </div>
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $('#comment_create').click(function() {
                $('.comment-new-field').toggleClass('hidden');
            });

            $('.comment-edit').click(function() {
                var comment = $(this).parent();
                var textComment = comment.children('#comment_text').text();
                comment.children('#comment_text').toggleClass('hidden');
                comment.children('#comment_text_edit').toggleClass('hidden');
            });

            $('.case-rating-btn').click(function(e) {
                e.preventDefault();
                var productId = $('.productId').text();
                var val = $(this).val();
                $.ajax({
                    url: '../product/ajaxRating',
                    type: 'POST',
                    data: {value : val, productId : productId},
                    dataType: 'json',
                    success: function(data) {
                        for (var i = 1; i <= 5; i++) {
                            if (i <= data) {
                                $('.case-rating-'+i).removeClass('case-rating-grey');
                                $('.case-rating-'+i).addClass('case-rating-green');
                            }
                            else {
                                $('.case-rating-'+i).removeClass('case-rating-green');
                                $('.case-rating-'+i).addClass('case-rating-grey');
                            }
                        }
                    }
                });
            });
        });
    </script>

@endsection