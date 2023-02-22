@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h1>Messaggi ricevuti</h1>
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
                            <a class="dropdown-item" href="{{route('admin.reviews.index', $profile->id)}}">Le mie Recensioni</a>
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

                {{-- {{dd($messages)}} --}}

                {{-- @foreach ($messages as $singleMessage)
                    <ul>
                        <li>

                            {{$singleMessage->surname}} {{$singleMessage->name}} ti domanda: {{ $singleMessage->message}},
                            puoi risponderli scivendo a: {{$singleMessage->email}}
                        </li>
                    </ul>
                @endforeach --}}

                @if (count($messages) > 0)
                    @foreach ($messages as $singleMessage)
                        <ul>
                            <li>

                                {{ $singleMessage->surname }} {{ $singleMessage->name }} ti domanda:
                                {{ $singleMessage->message }},
                                puoi risponderli scivendo a: {{ $singleMessage->email }}
                            </li>
                        </ul>
                    @endforeach
                @else
                    <h2 class="text-center">Non hai nessun messaggio</h2>
                @endif

            </div>
        </div>
    </div>
@endsection
