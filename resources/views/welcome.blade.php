@extends('layouts.app')

@section('content')
<div class="flex-container">
    <section class="hero is-primary">

        <div class="hero-body">
            <h1>Parliament of kenya</h1>
        </div>
    </section>
    <nav>
        <div class="navWide">
            <div class="wideDiv">
                <a href="#">Link 1</a>
                <a href="#">Link 2</a>
                <a href="#">Link 3</a>
            </div>
        </div>
        <div class="navNarrow">
            <i class="fa fa-bars fa-2x"></i>
            <div class="narrowLinks hidden">
                <a href="#">Link 1</a>
                <a href="#">Link 2</a>
                <a href="#">Link 3</a>
            </div>
        </div>
    </nav>
</div>
@endsection
