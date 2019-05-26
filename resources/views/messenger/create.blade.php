@extends('layouts.app')

@section('content')

<div class="columns">
    <div class="column is-one-third is-offset-one-third m-t-100">
        <div class="card">
            <div class="card-content">
                <form action="{{ route('messages.store') }}" method="post">


                    {{ csrf_field() }}

                    <!-- Subject Form Input -->
                    <div class="field">
                        <label class="label">Subject</label>
                        <p class="control">
                            <input type="text" class="input" name="subject" placeholder="Subject"
                                value="{{ old('subject') }}">
                        </p>

                    </div>

                    <!-- Message Form Input -->
                    <div class="field">
                        <label class="label">Message</label>
                        <p class="control">
                            <textarea name="message" class="textarea">{{ old('message') }}</textarea>
                        </p>
                    </div>

                    @if($users->count() > 0)
                    <div class="field">

                        @foreach($users as $user)
                        <p class="control">
                            <label title="{{ $user->name }} " class="checkbox"><input type="checkbox"
                                    name="recipients[]" value="{{ $user->id }} "> {!!$user->name!!}</label>
                        </p>

                        <br>
                        @endforeach

                    </div>

                    @endif

                    <!-- Submit Form Input -->
                    <div class="field">
                        <button type="submit" class="button is-primary is-fullwidth is-outlined">Send</button>
                    </div>



                </form>
            </div>
        </div>

    </div>
</div>



@endsection
