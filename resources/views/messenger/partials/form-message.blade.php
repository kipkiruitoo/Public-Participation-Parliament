<h2>Add a new message</h2>
<form action="{{ route('messages.update', $thread->id) }}" method="post">
    {{ method_field('put') }}
    {{ csrf_field() }}
        
    <!-- Message Form Input -->
    <div class="field">
        <textarea class="textarea" name="message" >{{ old('message') }}</textarea>
    </div>

    @if($users->count() > 0)
        
            @foreach($users as $user)
                <label class="checkbox" title="{{ $user->name }}">
                    <input  type="checkbox" name="recipients[]" value="{{ $user->id }}">{{ $user->name }}
                </label>
            @endforeach
        
    @endif

    <!-- Submit Form Input -->
    <div class="field m-t-30">
        <button type="submit" class="button is-primary is-fullwidth is-outlined">Send</button>
    </div>
</form>