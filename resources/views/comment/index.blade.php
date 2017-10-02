@extends('layouts.admin')

@section('content')

    <div class="comments-block">
        <h3>Comments</h3>
        <a href="/comment">all</a>
        <a href="/comment_new">new</a>

        @include('comment/_show')

        {{ $comments->links() }}

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
            $('.comment-seen-button').children('.btn').click(function(e) {
                e.preventDefault();
                var id = $(this).parent().parent().parent().children('.comment-id').text();
                $.ajax({
                    url: 'comment/ajaxChangeSeen',
                    type: 'POST',
                    data: {id : id },
                    dataType: 'json',
                    success: function(data) {
                        if($('.comment-seen-button-' + data).hasClass('comment-seen-1')) {
                            $('.comment-seen-button-' + data).removeClass('comment-seen-1');
                            $('.comment-seen-button-' + data).addClass('comment-seen-0');
                        }
                        else {
                            $('.comment-seen-button-' + data).removeClass('comment-seen-0');
                            $('.comment-seen-button-' + data).addClass('comment-seen-1');
                        }
                    }
                });
            });
        });
    </script>
@endsection