@extends('layouts.app')

@section('content')
<div class="columns">
    <div class="column is-one-third is-offset-one-third m-t-30" >
            <h1 class="has-text-centered has-text-weight-semibold is-capitalized">{{ $thread->subject }}</h1>
            @each('messenger.partials.messages', $thread->messages, 'message')
    
            @include('messenger.partials.form-message')
    </div>
</div>
    
@endsection
