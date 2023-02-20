@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">

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
