@extends('layouts.manage')

@section('content')
<div class="flex-container">
    <div class="columns m-t-10">
        <div class="column">
            <h1 class="title">{{$bill->title}}</h1>
            <h4 class="subtitle">view Bill details</h4>
        </div>
        <div class="column">
            <a href="{{route('bill.edit', $bill->id)}}" class="button is-primary is-pulled-right"><i
                    class="fa fa-user m-r-10"></i> Edit User</a>
        </div>
    </div>
    <hr class="m-t-0">
    <div class="card">
        <div class="card-content">
            <div class="field">
                <label for="" class="label">Title</label>
                <p class="control">
                    <pre>{{$bill->title}}</pre>
                </p>
            </div>
            <div class="field">
                <label for="" class="label">Description</label>
                <p class="control">
                    <pre>{{$bill->description}}</pre>
                </p>


            </div>


        </div>

    </div>
    <div class="card">
        <div class="card-content">
            <embed src="{{Storage::disk('local')->path($bill->file)}}.pdf" Content-Type='application/pdf'>
        </div>

    </div>
</div>
@endsection('content')
