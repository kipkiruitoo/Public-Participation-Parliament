<div class="card">
    <div class="card-header">
        <div class="card-header-icon">
            <img src="//www.gravatar.com/avatar/{{ md5($message->user->email) }} ?s=64" alt="{{ $message->user->name }}"
                style=" width: 25px; height: 25px;  border-radius:50%;">
        </div>
        <div class="card-header-title">
            <h5 class="media-heading">{{ $message->user->name }}</h5>
        </div>
    </div>
    <div class="card-content">

        <p>{{ $message->body }}</p>
        <div class="is-muted m-t-20">
            <small>Posted {{ $message->created_at->diffForHumans() }}</small>
        </div>

    </div>

</div>
