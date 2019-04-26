@extends('layouts.manage')

@section('content')
<div class="flex-container">
    <div class="columns m-t-10">
        <div class="column">
            <h1 class="title">Edit User</h1>
        </div>
    </div>
    <hr class="m-t-0">

    <form action="{{route('users.update', $user->id)}}" method="POST">
        {{method_field('PUT')}}
        {{csrf_field()}}
        <div class="columns">

            <div class="column">
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
                                <input class="input{{ $errors->has('idnumber') ? ' is-danger' : '' }}" type="number"
                                    name="idnumber" id="idnumber" placeholder="Your National ID number"
                                    value="{{$user->idnumber}}">

                            </p>
                            @if($errors->has('idnumber'))
                            <p class="help is-danger">{{$errors->first('idnumber')}}</p>
                            @endif

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

            <div class="column">
                <div class="card">
                    <div class="card-content">
                        <label for="roles" class="label">Roles:</label>
                        <input type="hidden" name="roles" :value="rolesSelected" />

                        @foreach ($roles as $role)
                        <div class="field">
                            <b-checkbox v-model="rolesSelected" :native-value="{{$role->id}}">{{$role->display_name}}
                            </b-checkbox>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
        <div class="columns">
            <div class="column">
                <hr />
                <button class="button is-primary is-pulled-right" style="width: 250px;">Edit User</button>
            </div>
        </div>
    </form>

</div> <!-- end of .flex-container -->
@endsection


@section('scripts')
<script>
    var app = new Vue({
        el: '#app',
        data: {
            password_options: 'keep',
            rolesSelected: {
                !!$user - > roles - > pluck('id') !!
            }
        }
    });

</script>
@endsection
