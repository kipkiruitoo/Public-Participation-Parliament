@extends('layouts.manage')
@section('content')
<div class="flex-container">
    <section class="hero is-primary">
        <div class="hero-body">
            <h1>View all Petitions</h1>
        </div>
    </section>
    <hr class="m-t-10">
    <div class="colums">
        <div class="column is-three-fifths is-offset-one-fifth">
            @foreach ($petitions as $petition)
            <div class="card">
                <div class="card-header">
                    <div class="card-header-title">
                        {{$petition->subject}}
                    </div>
                </div>
                <div class="card-content">
                    <p>
                        {{$petition->description}}
                    </p>
                    <hr>
                </div>
                <footer class="card-footer m-t-10 p-t-10 p-b-10 p-l-10 p-r-10">
                    <a href="#" class="card-footer-item button is-outlined is-link">Read Pdf</a>
                    <a href="#" class="card-footer-item button is-outlined is-info m-l-5">View Details</a>
                    <a href="#" class="card-footer-item button is-outlined m-l-5">Memoranda</a>
                </footer>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
