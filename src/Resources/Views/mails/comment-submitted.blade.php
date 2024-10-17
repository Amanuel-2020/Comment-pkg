@component('mail::message')
# A new comment has been posted for the course {{$comment->commentable->title}}.
Dear Instructor, a new comment has been created for the course {{$comment->commentable->title}} on the website of Amanuel w. Please respond appropriately as soon as possible.
@component('mail::panel')
@component('mail::button', ['url' => $comment->commentable->path()])
View Course
@endcomponent
@endcomponent
Thank you,<br>
{{ config('app.name') }}
@endcomponent
