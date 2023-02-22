@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                
                <div class="d-flex justify-content-between">
                    <h1>Reviews <small class="text-muted">{{ $profile->name }}</small></h1>
                    <div class="dropdown mr-3 align-self-center">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                            Action
                        </button>
                        <ul class="dropdown-menu">
                          <li> 
                            <a class="dropdown-item" href="{{route('admin.profile.edit', $profile->id)}}">Modifica Profilo</a>
                          </li>
                        <li>
                            <a class="dropdown-item" href="{{route('admin.profile.show', $profile->id)}}">Il mio profilo</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{route('admin.messages.index', $profile->id)}}">I miei messaggi</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{route('admin.sponsors.index', $profile->id)}}">Aggiungi Sponsor</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{route('admin.statistics.index', $profile->id)}}">Statistiche</a>
                        </li>
                        </ul>
                    </div>
                </div>
                {{-- Qua sotto va fatto foreach --}}

                @if (count($reviews) > 0)
                    @foreach ($reviews as $rev)
                        <ul>
                            <li>
                                Recensione di {{ $rev->name }}: {{ $rev->review }}
                            </li>
                        </ul>
                    @endforeach
                @else
                    <h2 class="text-center">Non hai ancora nessuna recensione</h2>
                @endif

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
