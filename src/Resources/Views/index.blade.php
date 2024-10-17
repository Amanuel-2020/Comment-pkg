@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('comments.index')}}" title="Comments">Comments</a></li>
@endsection
@section('content')
    <div class="tab__box">
        <div class="tab__items">
            <a class="tab__item {{request('status') ==''  ? 'is-active' : ""}}"
               href="{{route('comments.index')}}?=status=">
                All Comments</a>
            <a class="tab__item {{request('status') == \amanuel\Comment\Models\Comment::STATUS_NEW  ? 'is-active' : ""}}"
               href="{{route('comments.index')}}?status={{\amanuel\Comment\Models\Comment::STATUS_NEW}}">Unapproved
                Comments</a>
            <a class="tab__item {{request('status') == \amanuel\Comment\Models\Comment::STATUS_REJECTED  ? 'is-active' : ""}}"
               href="{{route('comments.index')}}?status={{\amanuel\Comment\Models\Comment::STATUS_REJECTED}}">Rejected
                Comments</a>
            <a class="tab__item {{request('status') == \amanuel\Comment\Models\Comment::STATUS_APPROVED  ? 'is-active' : ""}}"
               href="{{route('comments.index')}}?status={{\amanuel\Comment\Models\Comment::STATUS_APPROVED}}">Approved
                Comments</a>
        </div>
    </div>
    <div class="bg-white padding-20">
        <div class="t-header-search">
            <form action="">
                <div class="t-header-searchbox font-size-13">
                    <input type="text" class="text search-input__box font-size-13" placeholder="Search in comments">
                    <div class="t-header-search-content">
                        <input type="text" class="text" name="body" placeholder="Part of the text">
                        <input type="text" class="text" name="email" placeholder="Email">
                        <input type="text" class="text margin-bottom-20" name="name" placeholder="First and last name">
                        <button type="submit" class="btn btn-brand">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="table__box">
        <table class="table">
            <thead role="rowgroup">
            <tr role="row" class="title-row">
                <th>ID</th>
                <th>Sender</th>
                <th>For</th>
                <th>Comment</th>
                <th>Date</th>
                <th>Number of Replies</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($comments as $comment)
                <tr role="row">
                    <td><a href="">{{$comment->id}}</a></td>
                    <td><a href="">{{$comment->user->name}}</a></td>
                    <td><a href="">{{$comment->commentable->title}}</a></td>
                    <td>{{$comment->body}}</td>
                    <td>{{\Morilog\Jalali\Jalalian::fromCarbon($comment->created_at)}}</td>
                    <td>{{$comment->comments()->count()}} ({{$comment->not_approved_comments_count}})</td>
                    <td class="confirmation_status {{$comment->getStatusCssClass()}}">@lang($comment->status)</td>
                    <td>
                        <a href="{{route('comments.show', $comment->id)}}" class="item-eye mlg-15" title="View"></a>
                        @can(\amanuel\RolePermissions\Models\Permission::PERMISSION_MANAGE_COMMENTS)
                            <a href=""
                               onclick="deleteItem(event, '{{ route('comments.destroy', $comment->id)}}');"
                               class="item-delete mlg-15" title="Delete"></a>
                            <a href=""
                               onclick="updateConfirmationStatus(event, '{{ route('comments.accept', $comment->id)}}',
                                   'Are you sure you want to approve this item?', 'Approved');"
                               class="item-confirm mlg-15" title="Approve"></a>
                            <a href=""
                               onclick="updateConfirmationStatus(event, '{{ route('comments.reject', $comment->id)}}',
                                   'Are you sure you want to reject this item?', 'Rejected');"
                               class="item-reject mlg-15"
                               title="Reject"></a>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
