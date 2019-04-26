@extends('layouts.app')

@section('content')
@if (session('status'))
    <div class="notification is-success" role="alert">
        {{ session('status') }}
    </div>
                    @endif
<div class="columns">
    <div class="column is-one-third is-offset-one-third m-t-100">
        <div class="card">
            <!-- start of card content -->
    
            <div class="card-content">
                <h1 class="title">Reset Your Password</h1>
                <form action="{{route('register')}}" method="post" role="form">
                @csrf
                <input type="token" name="token" value="{{ $token }}">
                <div class="field">
                    <label for="" class="label">Email</label>
                    <p class="control">
                        <input class="input{{ $errors->has('email') ? ' is-danger' : '' }}"  type="email" name="email" id="email" placeholder="name@domain.ext" value="{{ old('email') }}">

                    </p>
                    @if($errors->has('email'))
                   <p class="help is-danger">{{$errors->first('email')}}</p>
                    @endif
                   
                </div>
                <div class="columns">
                    <div class="column">
                         <div class="field">
                    <label for="" class="label">Password</label>
                    <p class="control">
                        <input class="input{{ $errors->has('password') ? ' is-danger' : '' }}" type="password" name="password" id="password" placeholder="">
                        
                    </p>
                    @if($errors->has('password'))
                   <p class="help is-danger">{{$errors->first('password')}}</p>
                    @endif
                </div>
                    </div>
               <div class="column">
                   <div class="field">
                    <label for="" class="label">Confirm Password</label>
                    <p class="control">
                        <input class="input{{ $errors->has('password_confirmation') ? ' is-danger' : '' }}" type="password" name="password_confirmation" id="password" placeholder="">
                        
                    </p>
                    @if($errors->has('password_confirmation'))
                   <p class="help is-danger">{{$errors->first('password_confirmation')}}</p>
                    @endif
                </div> 
               </div>
               
                </div>

                    <button type="submit" class=" button is-primary is-outlined is-fullwidth m-t-30">Reset password</button>
                
                </form>
                
                
            </div><!-- end of card content -->
            
        </div>
        <h5 class="has-text-centered"><a href="{{route('login')}}" class="is-muted">Already signed up?</a></h5>
    </div>
</div>
@endsection
