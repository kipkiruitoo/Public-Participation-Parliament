<?php $class = $thread->isUnread(Auth::id()) ? 'alert-info' : ''; ?>
<div class="columns">
    <div class="column m-t-50 is-one-third is-offset-one-third">
        <article class="message is-dark">
            <div class="message-header">
                <p>
                    <a href="{{ route('messages.show', $thread->id) }}">{{ $thread->subject }}</a>
                    ({{ $thread->userUnreadMessagesCount(Auth::id()) }} unread)
                </p>
            </div>
            <div class="message-body">
                <p>{{ $thread->latestMessage->body }}</p>
            </div>
            <div class="columns">
                <div class="column p-t-10 p-l-30 is-one-third">
                    <small><strong>Creator:</strong> {{ $thread->creator()->name }}</small>
                </div>
                <div class="colum p-t-10 is-two-thirds">
                    <small><strong>Participants:</strong> {{ $thread->participantsString(Auth::id()) }}</small>
                </div>
            </div>
        </article>
    </div>
</div>
