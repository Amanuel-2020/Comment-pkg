@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('comments.index')}}" title="Comments">Comments</a></li>
@endsection
@section('content')
    <div class="main-content">
        <div class="show-comment">
            <div class="ct__header">
                <div class="comment-info">
                    <a class="back" href="{{route('comments.index')}}"></a>
                    <div>
                        <p class="comment-name"><a href="">{{$comment->commentable->title}}</a></p>
                    </div>
                </div>
            </div>
            @include('Comments::comment', ['comment'=>$comment, "isAnswer"=>false])
            @foreach($comment->comments as $reply)
                @include('Comments::comment', ['comment'=>$reply, "isAnswer"=>true])
            @endforeach
        </div>
        <div class="answer-comment">
            <p class="p-answer-comment">Send a reply</p>
            @if($comment->status == Abd\Comment\Models\Comment::STATUS_APPROVED)
                <form action="{{route("comments.store")}}" method="post">
                    @csrf
                    <input type="hidden" name="comment_id" value="{{$comment->id}}">
                    <input type="hidden" name="commentable_type" value="{{get_class($comment->commentable)}}">
                    <input type="hidden" name="commentable_id" value="{{$comment->commentable->id}}">
                    <x-textarea name="body" placeholder="Write a comment..."/>
                    <button type="submit" class="btn btn-brand">Send reply</button>
                </form>
            @else
                <p class="text-error">To send a reply to this comment, please approve it first.</p>
            @endif
        </div>
    </div>
@endsection
