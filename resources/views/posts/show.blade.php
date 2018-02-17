@extends('layouts.master')

@section('content')
    <div class="col-sm-8 blog-main">
        <h1>{{ $post->title }}</h1>

        @if(count($post->tags))
            <ul>
                @foreach($post->tags as $tag)
                    <li>
                        <a href="/posts/tags/{{ $tag->name }}">{{ $tag->name }}</a>
                    </li>
                @endforeach
            </ul>
        @endif
        <hr/>
        <div>
            {{ $post->body }}
        </div>
        <hr/>
        @if($post->image != null)
            <div>
                <img width="320" height="240" src="/images/{{ $post->image }}" />
            </div>
        @endif
        @if($post->video != null)
            <div>
                <video width="320" height="240" controls>
                    <source src="/videos/{{ $post->video }}" type="video/mp4">
                    <source src="/videos/{{ $post->video }}" type="video/ogg">
                    Your browser does not support the video tag.
                </video>
            </div>
        @endif

        <hr/>

        {{-- Add Comments --}}

        <div class="card">
            <div class="card-block">

                <form method="POST" action="/posts/{{ $post->id }}/comments">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <textarea name="body" placeholder="Your comment here." class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Add Comment</button>
                    </div>

                </form>

                @include('layouts.errors')

            </div>
        </div>

        <div class="comments">
            <ul class="list-group">
                @foreach($post->comments as $comment)
                    <li class="list-group-item">
                        <strong>
                            {{ $comment->created_at->diffForHumans() }}: &nbsp;
                        </strong>

                        {{ $comment->body }}
                        <div>
                            <strong>{{ $comment->user->name }}</strong>
                        </div>

                        <div class="action">
                            <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal"
                                        data-target="#{{$comment->id}}">
                                    Edit
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="{{$comment->id}}" tabindex="-1" role="dialog"
                                     aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h4 class="modal-title" id="modelTitleId">Update Comment</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="comment-form">

                                                    <form method="POST" action="{{route('comment.update', $comment->id)}}" role="form">
                                                        {{ csrf_field() }}
                                                        {{method_field('put')}}

                                                        <legend>Edit Comment</legend>

                                                        <div class="form-group">
                                                            <textarea name="body" class="form-control" required>{{$comment->body}}</textarea>
                                                        </div>

                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-primary">Update Comment</button>
                                                        </div>

                                                    </form>

                                                    @include('layouts.errors')

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--//delete form--}}
                            <form action="{{route('comment.destroy', $comment->id)}}" method="POST" class="inline-it">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <input class="btn btn-xs btn-danger" type="submit" value="Delete">
                            </form>
                        </div>
                    </li>

                <hr/>

                {{--reply to comment--}}

                <div style="margin-left: 40px">

                    <button class="btn btn-xs btn-info" style="margin-bottom: 5px" onclick="togleReply('{{$comment->id}}')">Reply</button>
                    <br/>

                    {{--reply-form--}}

                    <div class="reply-form-{{$comment->id}} hidden">
                        <div class="card-block">

                            <form method="POST" action="{{route('replyComment.store', $comment->id)}}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <textarea name="body" placeholder="Your reply here." class="form-control" required></textarea>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Add Reply</button>
                                </div>

                            </form>

                            @include('layouts.errors')

                        </div>
                    </div>
                    <hr/>

                    <div style="margin-bottom: 10px">
                        @foreach($comment->comments as $reply)
                            <li class="list-group-item">
                                <strong>
                                    {{ $reply->created_at->diffForHumans() }}: &nbsp;
                                </strong>

                                {{ $reply->body }}
                                <div>
                                    <strong>{{ $reply->user->name }}</strong>
                                </div>

                                <div class="action">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal"
                                            data-target="#{{$reply->id}}">
                                        Edit
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="{{$reply->id}}" tabindex="-1" role="dialog"
                                         aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <h4 class="modal-title" id="modelTitleId">Update Reply</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="comment-form">

                                                        <form method="POST" action="{{route('comment.update', $reply->id)}}" role="form">
                                                            {{ csrf_field() }}
                                                            {{method_field('put')}}

                                                            <legend>Edit Reply</legend>

                                                            <div class="form-group">
                                                                <textarea name="body" class="form-control" required>{{$reply->body}}</textarea>
                                                            </div>

                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-primary">Update reply</button>
                                                            </div>

                                                        </form>

                                                        @include('layouts.errors')

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--//delete form--}}
                                    <form action="{{route('comment.destroy', $reply->id)}}" method="POST" class="inline-it">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <input class="btn btn-xs btn-danger" type="submit" value="Delete">
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </ul>
        </div>

        <hr>


    </div>
@endsection

@section('customJS')
    <script>
        function togleReply(commentId) {
            $('.reply-form-'+commentId).toggleClass('hidden');
        }
    </script>
@endsection
