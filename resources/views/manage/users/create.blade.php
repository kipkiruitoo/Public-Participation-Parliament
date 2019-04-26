
@extends('layouts.manage')

@section('content')
    <div class="flex-container">
        <div class="colums m-t-10">
            <div class="column">
                <h1 class="title">Create new User</h1>
            </div>
        </div>
        <hr class="m-t-0">
        <div class="columns">
            <div class="column">
                    <div class="card">
                            <!-- start of card content -->
                    
                            <div class="card-content">
                                
                                <form action="{{route('users.store')}}" method="post" role="form">
                                @csrf
                            
                                <div class="field">
                                    <label for="" class="label">Name</label>
                                    <p class="control">
                                        <input class="input{{ $errors->has('name') ? ' is-danger' : '' }}"  type="text" name="name" id="name" placeholder="John doe" value="{{ old('name') }}">
                
                                    </p>
                                    @if($errors->has('name'))
                                   <p class="help is-danger">{{$errors->first('name')}}</p>
                                    @endif
                                   
                                </div>
                                <div class="field">
                                    <label for="" class="label">Phone Number</label>
                                    <p class="control">
                                        <input class="input{{ $errors->has('phone') ? ' is-danger' : '' }}"  type="number" name="phone" id="phone" placeholder="07********"value="{{ old('idnumber') }}">
                
                                    </p>
                                    @if($errors->has('phone'))
                                   <p class="help is-danger">{{$errors->first('phone')}}</p>
                                    @endif
                                   
                                </div>
                                <div class="field">
                                    <label for="" class="label">Email</label>
                                    <p class="control">
                                        <input class="input{{ $errors->has('email') ? ' is-danger' : '' }}"  type="email" name="email" id="email" placeholder="name@domain.ext" value="{{ old('email') }}">
                
                                    </p>
                                    @if($errors->has('email'))
                                   <p class="help is-danger">{{$errors->first('email')}}</p>
                                    @endif
                                   
                                </div>
                                <div class="field">
                                    <label for="" class="label">Id Number</label>
                                    <p class="control">
                                        <input class="input{{ $errors->has('idnumber') ? ' is-danger' : '' }}"  type="number" name="idnumber" id="idnumber" placeholder="Your National ID number" value="{{ old('idnumber') }}">
                
                                    </p>
                                    @if($errors->has('idnumber'))
                                   <p class="help is-danger">{{$errors->first('idnumber')}}</p>
                                    @endif
                                   
                                </div>
                               
                                         <div class="field">
                                    <label for="" class="label">Password</label>
                                    <p class="control">
                                        <input class="input" type="password" name="password" id="password" v-if="!auto_password" placeholder="Manually give a password">
                                        <b-checkbox class="m-t-15" name="auto_generate"  v-model="auto_password">Auto Generate Password</b-checkbox>
                                    </p>
                                    @if($errors->has('password'))
                                   <p class="help is-danger">{{$errors->first('password')}}</p>
                                    @endif
                                </div>
                                    
                
                                    <button type="submit" class=" button is-success  is-fullwidth m-t-20 m-l-5 m-r-5 m-b-10">Create</button>
                                
                                </form>
                                
                                
                            </div><!-- end of card content -->
                            
                        </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        var app = new Vue({
          el: '#app',
          data: {
            auto_password: true,
            rolesSelected: [{!! old('roles') ? old('roles') : '' !!}]
          }
        });
</script>
@endpush



