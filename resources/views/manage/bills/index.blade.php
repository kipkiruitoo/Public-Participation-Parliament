@extends('layouts.manage')

@section('content')
<div class="flex-container">
    <div class="columns m-t-10">
        <div class="column">
            <h1 class="title">All bills will appear here</h1>
        </div>
        <div class="column">
            <a href="{{route('bill.create')}}" class="button is-primary is-pulled-right"><i
                    class="fa fa-user-plus m-r-10"></i>Add new Bill</a>
        </div>
    </div>
    <hr class="m-t-0">
    <div class="card">
        <div class="card-content">
            <table class="table ">
                <thead>
                    <tr>
                        <th>Number</th>
                        <th>Title</th>

                        <th>Published at</th>
                        <th>File</th>
                        <th>Actions</th>
                    </tr>

                </thead>
                <tbody>
                    @foreach ($bills as $bill)
                    <tr>
                        <td>{{$bill->number}}</td>
                        <td>{{$bill->name}}</td>
                        <td>{{$bill->published_at}}</td>
                        <td><a href="{{route('viewpdf', $bill->id)}}" class="button is-warning">View Pdf</a></td>
                        <td>
                            <a href="{{route('bill.edit', $bill->id)}}" class="button is-success">Edit</a>
                        </td>
                        <td><a href="{{route('bill.show', $bill->id)}}" class="button is-primary">View</a></td>
                    </tr>

                    @endforeach
                    <div class="modal">
                        <div class="modal-background"></div>
                        <div class="modal-content"> this is the content of the modal</div>
                        <div class="modal-close is-large" aria-label="close"></div>
                    </div>
                </tbody>
            </table>
        </div>
    </div>
    @endsection
    @push('scripts')
    <script src="">
        $("#show").click(function () {
            $(".modal").addClass("is-active");
            console.log('i was clicked')
        });

        $(".modal-close").click(function () { 
            $(".modal").removeClass("is-active");
        });

    </script>
    @endpush
