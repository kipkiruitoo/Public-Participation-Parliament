@extends('layouts.manage')

@section('content')
<div class="flex-container">
    <div class="colums m-t-10">
        <div class="column">
            <h1 class="title">Edit User</h1>
        </div>
    </div>
    <hr class="m-t-0">
    <div class="columns">
        <div class="column">
            <div class="card">
                <!-- start of card content -->

                <div class="card-content">

                    <form action="{{route('users.update', $user->id )}}" method="post" role="form">
                        {{method_field('PUT')}}
                        @csrf

                        <div class="field">
                            <label for="" class="label">Name</label>
                            <p class="control">
                                <input class="input{{ $errors->has('name') ? ' is-danger' : '' }}" type="text" name="name" id="name" placeholder="John doe" value="{{$user->name}}">

                            </p>
                            @if($errors->has('name'))
                            <p class="help is-danger">{{$errors->first('name')}}</p>
                            @endif

                        </div>
                        <div class="field">
                            <label for="" class="label">Phone Number</label>
                            <p class="control">
                                <input class="input{{ $errors->has('phone') ? ' is-danger' : '' }}" type="number" name="phone" id="phone" placeholder="07********" value="{{ $user->phone }}">

                            </p>
                            @if($errors->has('phone'))
                            <p class="help is-danger">{{$errors->first('phone')}}</p>
                            @endif

                        </div>
                        <div class="field">
                            <label for="" class="label">Email</label>
                            <p class="control">
                                <input class="input{{ $errors->has('email') ? ' is-danger' : '' }}" type="email" name="email" id="email" placeholder="name@domain.ext" value="{{ $user->email }}">

                            </p>
                            @if($errors->has('email'))
                            <p class="help is-danger">{{$errors->first('email')}}</p>
                            @endif

                        </div>
                        <div class="field">
                            <label for="" class="label">Id Number</label>
                            <p class="control">
                                <input class="input{{ $errors->has('idnumber') ? ' is-danger' : '' }}" type="number" name="idnumber" id="idnumber" placeholder="Your National ID number" value="{{$user->idnumber}}">

                            </p>
                            @if($errors->has('idnumber'))
                            <p class="help is-danger">{{$errors->first('idnumber')}}</p>
                            @endif

                        </div>
                        <div class="field">
                            <label for="" class="label">Password</label>
                            <p class="control">
                                <input class="input" type="password" name="password" id="password" v-if="!auto_password" placeholder="Do not type if you want to keep the password">
                                <b-checkbox class="m-t-15" name="auto_generate" v-model="auto_password">Auto
                                    Generate Password</b-checkbox>
                            </p>
                            @if($errors->has('password'))
                            <p class="help is-danger">{{$errors->first('password')}}</p>
                            @endif
                        </div>


                </div><!-- end of card content -->

            </div>
        </div>
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
        <hr>



        <div class="columns">
            <div class="column">
                <button type="submit" class=" button is-success  is-fullwidth m-t-20 m-l-5 m-r-5 m-b-10">Edit
                    User</button>

            </div>
        </div>
        </form>
    </div>
</div>

@endsection
@push('scripts')
<script>
    Vue.use(Buefy);
    var app = new Vue({
        el: '#app',
        data: {
            auto_password: true,
            password_options: 'keep',
            rolesSelected: {
                !!$user - > roles - > pluck('id') !!
            }
        }
    });
</script>

@endpush