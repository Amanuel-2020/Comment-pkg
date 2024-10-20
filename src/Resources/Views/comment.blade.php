<div class="transition-comment {{$isAnswer ? "is-answer" : ""}}">
    <div class="transition-comment-header">
       <span>
            <img src="{{$comment->user->thumb}}" alt="{{$comment->user->name}}" class="logo-pic">
       </span>
        <span class="nav-comment-status">
            <p class="username">User: {{$comment->user->name}}</p>
            <p class="comment-date">{{$comment->created_at->diffForHumans()}}</p>
            <span class="confirmation_status {{$comment->getStatusCssClass()}}">@lang($comment->status)</span>
        </span>
        @if($isAnswer)
            <div class="comment-actions">
                <a href=""
                   onclick="deleteItem(event, '{{ route('comments.destroy', $comment->id)}}', 'div.transition-comment');"
                   class="item-delete mlg-15" title="Delete"></a>
                <a href="" onclick="updateConfirmationStatus(event, '{{ route('comments.accept', $comment->id)}}',
                    'Are you sure you want to approve this item?', 'Approved','confirmation_status', 'div.transition-comment', 'span.');"
                   class="item-confirm mlg-15" title="Approve"></a>
                <a href="" onclick="updateConfirmationStatus(event, '{{ route('comments.reject', $comment->id)}}',
                    'Are you sure you want to reject this item?','Rejected','confirmation_status', 'div.transition-comment', 'span.');"
                   class="item-reject mlg-15" title="Reject"></a>
            </div>
        @endif
    </div>
    <div class="transition-comment-body">
        <pre>
            {{$comment->body}}
        </pre>
    </div>
</div>
