@extends('layouts.manage')

@section('content')
    <div class="flex-container">
        <div class="columns m-t-10">
            <div class="column">
                <h1 class="title">{{$user->name}}</h1>
                <h4 class="subtitle">view user details</h4>
            </div>
            <div class="column">
                <a href="{{route('users.edit', $user->id)}}" class="button is-primary is-pulled-right"><i class="fa fa-user m-r-10"></i> Edit User</a>
            </div>
        </div>
        <hr class="m-t-0">
        <div class="card">
            <div class="card-content">
                        <div class="field">
                <label for="" class="label">Name</label>
                <p class="control">
                    <pre>{{$user->name}}</pre>
                </p>
            </div>
            <div class="field">
                <label for="" class="label">Phone Number</label>
                <p class="control">
                    <pre>{{$user->phone}}</pre>
                </p>
            
               
            </div>
            <div class="field">
                <label for="" class="label">Email</label>
                <p class="control">
                        <pre>{{$user->email}}</pre>
                </p>
                
               
            </div>
            <div class="field">
                <label for="" class="label">Id Number</label>
                <p class="control">
                        <pre>{{$user->idnumber}}</pre>
                </p>
               
               
            </div>
            <div class="field">
                <label for="" class="label">Roles</label>
                <ul>
                    {{$user->roles->count() == 0 ? 'This user has not been assigned any roles yet': ''}}
                    @foreach ($user->roles as $role)
                      <li>{{$role->display_name}}  {{$role->description}}</li>  
                    @endforeach
                </ul>
                <p class="control">
                        {{-- <pre>{{$user->roles}}</pre> --}}
                </p>
               
               
            </div>
            </div>
        </div>

    </div>

@endsection