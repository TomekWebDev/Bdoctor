@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                @foreach ($sponsors as $sponsor)
                    <h1>Sponsor: <small class="text-secondary">{{$sponsor->name}}</small></h1>
                @endforeach
            </div>
        </div>
    </div>

@endsection
