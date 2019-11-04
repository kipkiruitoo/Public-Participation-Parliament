@extends('layouts.manage')

@section('content')
<div class="flex-container">
    <div class="columns m-t-10">
        <div class="column">
            <div class="title">Manage Users</div>
        </div>
        <div class="column">
            <a href="{{route('users.create')}}" class="button is-primary"><i class="fa fa-user-add m-r-10"></i>Create New User</a>
        </div>
    </div> 
    <hr>
    <div class="columns">
    <div class="column">
    <div id="app">
    <user-search></user-search>
    </div>
     
    </div>
    </div>
    <div class="card">
        <div class="card-content">
                <table class="table is-narrow table ">
                        <thead>
                            <tr>
                                <th>no</th>
                                <th>Name</th>
                                <th>Id number</th>
                                <th>Email</th>
                                <th>phone number</th>
                                <th>Online Status</th>
                                <th>Date created</th>
                                <th>Actions</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($users as $user)
                            <tr>
                                    <th>{{$user->id}}</th> 
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->idnumber}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->phone}}</td>
                                    <td>
                                        @if ($user->isOnline())
                                            <li class="has-text-success">
                                                Online
                                            </li>
                                        @else
                                        <li class="has-text-danger">
                                                Offline
                                            </li>
                                        @endif
                                    </td>
                                    <td>{{$user->created_at->toFormattedDateString()}}</td>
                                    <td class="has-text-right">
                                            <a href="{{route('users.show', $user->id)}}" class="button is-outlined is-primary">View</a>
                                        <a href="{{route('users.edit', $user->id)}}" class="button is-outlined is-primary">Edit</a>
                                    </td>
                                 </tr>
                            @endforeach
                            
                            
                        </tbody>
                    </table>
        </div>
    </div>
    {{$users->links()}}
</div>
@endsection