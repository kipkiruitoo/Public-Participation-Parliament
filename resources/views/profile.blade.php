@extends('layouts.app')

@section('content')
<section class="hero is-primary">
    <div class="hero-body">
        <div class="container">
            <div class="columns">
                <div class="column is-one-third">
                    <img src="/uploads/avatars/{{ $user->avatar }}"
                        style=" width: 75px; height: 75px;  border-radius:50%; margin-right: 25px;" alt="">
                    <form action="/profile" enctype="multipart/form-data" method="POST">
                        <div class="field">
                            <div class="file is-small">
                                <div class="file-label">
                                    <input class="input" type="file" name="avatar" id="file">
                                </div>
                            </div>



                            <div class="control">
                                @csrf
                                <input class="button is-white m-t-10 " value="Upload" type="submit">
                            </div>
                        </div>



                    </form>
                </div>
                <div class="column is-two-thirds">
                    <h1 class="title">
                        <h1>{{$user->name}}</h1>
                    </h1>
                </div>
            </div>


            <hr>
            <h2 class="subtitle">
                Edit Your profile
            </h2>
        </div>
    </div>
</section>
<div class="flex-container">

    <form action="{{route('updateprofile', $user->id)}}" method="POST">
        {{method_field('PUT')}}
        {{csrf_field()}}
        <div class="columns">

            <div class="column is-three-fifths is-offset-one-fifth">
                <div class="card">
                    <div class="card-content">
                        <div class="field">
                            <label for="" class="label">Name</label>
                            <p class="control">
                                <input class="input{{ $errors->has('name') ? ' is-danger' : '' }}" type="text"
                                    name="name" id="name" placeholder="John doe" value="{{$user->name}}">

                            </p>
                            @if($errors->has('name'))
                            <p class="help is-danger">{{$errors->first('name')}}</p>
                            @endif

                        </div>
                        <div class="field">
                            <label for="" class="label">Phone Number</label>
                            <p class="control">
                                <input class="input{{ $errors->has('phone') ? ' is-danger' : '' }}" type="number"
                                    name="phone" id="phone" placeholder="07********" value="{{ $user->phone }}">

                            </p>
                            @if($errors->has('phone'))
                            <p class="help is-danger">{{$errors->first('phone')}}</p>
                            @endif

                        </div>
                        <div class="field">
                            <label for="" class="label">Email</label>
                            <p class="control">
                                <input class="input{{ $errors->has('email') ? ' is-danger' : '' }}" type="email"
                                    name="email" id="email" placeholder="name@domain.ext" value="{{ $user->email }}">

                            </p>
                            @if($errors->has('email'))
                            <p class="help is-danger">{{$errors->first('email')}}</p>
                            @endif

                        </div>
                        <div class="field">
                            <label for="" class="label">Id Number</label>
                            <p class="control">
                                <p>{{$user->idnumber}}</p>
                            </p>
                            
                            <p class="help is-info">Contact Admin to change the Id number</p>
 

                        </div>
                        <div class="field">
                            <label for="" class="label">Password</label>
                            <p class="control">
                                <input class="input" type="password" name="password" id="password" v-if="!auto_password"
                                    placeholder="Do not type if you want to keep the password">
                                <b-checkbox class="m-t-15" name="auto_generate" v-model="auto_password">Auto
                                    Generate Password</b-checkbox>
                            </p>
                            @if($errors->has('password'))
                            <p class="help is-danger">{{$errors->first('password')}}</p>
                            @endif
                        </div>
                    </div>
                </div>

            </div> <!-- end of .column -->
            <hr>
            
        </div>
        <div class="columns">
            <div class="column is-three-fifths is-offset-one-fifth">
                <button class="button is-primary is-outlined is-fullwidth" >Update Profile</button>
            </div>
        </div>
      
       
    </form>

</div>

@endsection
