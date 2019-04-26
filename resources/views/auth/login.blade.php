@extends('layouts.app')

@section('content')

<div class="columns">
    <div class="column is-one-third is-offset-one-third m-t-100">
        <div class="card">
            <!-- start of card content -->
    
            <div class="card-content">
                <h1 class="title">login</h1>
                <form action="{{route('login')}}" method="post" role="form">
                @csrf
            
                <div class="field">
                    <label for="idnumber" class="label">Id Number</label>
                    <p class="control">
                        <input class="input{{ $errors->has('idnumber') ? ' is-danger' : '' }}"  type="tel" name="idnumber" id="idnumber" placeholder="Your National ID number" value="{{ old('idnumber') }}">

                    </p>
                    @if($errors->has('idnumber'))
                   <p class="help is-danger">{{$errors->first('idnumber')}}</p>
                    @endif
                   
                </div>
                <div class="field">
                    <label for="password" class="label">Password</label>
                    <p class="control">
                        <input class="input{{ $errors->has('password') ? ' is-danger' : '' }}" type="password" name="password" id="password" placeholder="">
                        
                    </p>
                    @if($errors->has('password'))
                   <p class="help is-danger">{{$errors->first('password')}}</p>
                    @endif
                </div>
                    <b-checkbox  name="remember" class="m-t-20">Remember Me</b-checkbox>

                    <button type="submit" class=" button is-success is-outlined is-fullwidth m-t-30">Login</button>
                
                </form>
                
                
            </div><!-- end of card content -->
            
        </div>
        <h5 class="has-text-centered"><a href="{{route('password.request')}}" class="is-muted">Forgot password?</a></h5>
    </div>
</div>



@endsection
