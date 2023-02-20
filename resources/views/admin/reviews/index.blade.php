@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h1>Reviews <small class="text-secondary">{{ $profile->name }}</small></h1>
                {{-- Qua sotto va fatto foreach --}}
                @foreach ($reviews as $rev)
                    <ul>
                        <li>
                            Recensione di {{ $rev->name }}: {{ $rev->review }}
                        </li>
                    </ul>
                @endforeach

                <br>

                @foreach ($ratings as $rating)
                    <ul>
                        <li>Rating: {{ $rating->rating_id }}</li>
                    </ul>
                @endforeach

                {{-- {{dd($ratings)}} --}}
            </div>
        </div>
    </div>
@endsection
