@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h1>Reviews <small class="text-secondary">{{ $profile->name }}</small></h1>
                qua va fatto forerach Testo recensione: {{ $reviews[0]->review }}
            </div>
        </div>
    </div>
@endsection
