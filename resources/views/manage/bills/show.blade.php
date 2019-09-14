@extends('layouts.manage')

@section('content')
<div class="flex-container">
    <div class="columns m-t-10">
        <div class="column">
            <h1 class="title">{{$bill->title}}</h1>
            <h4 class="subtitle">view Bill details</h4>
        </div>
        <div class="column">
        
        <a href="{{route('viewpdf', $bill->id)}}" class="button is-warning">View Pdf</a>
        </div>
        <div class="column">
            <a href="{{route('bill.edit', $bill->id)}}" class="button is-primary is-pulled-right"><i
                    class="fa fa-user m-r-10"></i> Edit Bill</a>
        </div>
    </div>
    <div class="columns">
    <div class="column">
     <div class="card">
        <div class="card-content">
            <div class="field">
                <label for="" class="label">Title</label>
                <p class="control">
                    <pre>{{$bill->name}}</pre>
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
    </div>
    </div>

    <hr class="m-t-0">
    <hr>
    <div class="columns">
    <div class="column">
            <div class="field">
                <label for="">Average Sentiment Score ( positive or negative)</label>
                <p class="control">
                    <pre>{{$avscore}}</pre>
                </p>
            </div>
            <div class="field">
                <div class="control">
                    <pre>{{$scomment}}</pre>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="field">
                <label for="">Average Magnitude Score (Emotion of the Comment)</label>
                <p class="control">
                    <pre>{{$avmagnitudes}}</pre>
                </p>
            </div>
            <div class="field">
                <div class="control">
                    <pre>{{$mcomment}}</pre>
                </div>
            </div>
        </div>
    </div>
    <div class="columns m-t-20">
    <div class="column">
    <div class="card">
    <div class="field "><p class="control has-text-centered">
        Comments on this bill
    </p></div>
    <div class="card-body">
   <ul class="list is-hoverable">

  
    @foreach ($comments as $comment)
     <li class="list-item m-t-10 p-20">
   

     {!!$comment->body!!}
</li>

    @endforeach 
</ul>
    </div>
    </div>
    </div> 
    <div class="column">
    {!! $sentchart->html() !!}
    </div>
    </div>
   
   
</div>
{!! Charts::scripts() !!}
{!! $sentchart->script( ) !!}
@endsection('content')
