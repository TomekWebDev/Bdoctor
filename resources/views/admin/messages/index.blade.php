@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="dropdown mr-3 d-flex flex-row-reverse">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"
                style="background-color: #076dbb">
                Action
            </button>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item" href="{{ route('admin.index', $profile->id) }}">Dashboard</a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('admin.profile.edit', $profile->id) }}">Modifica Profilo</a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('admin.reviews.index', $profile->id) }}">Le mie Recensioni</a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('admin.sponsors.index', $profile->id) }}">Aggiungi Sponsor</a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('admin.statistics.index', $profile->id) }}">Statistiche</a>
                </li>
            </ul>
        </div>

        {{-- MESSAGGI --}}
        <div class="card mt-4 text-center">
            <h1 class="mt-3">Messaggi ricevuti</h1>
            <div class="card-body">
                {{-- <button id="buttonMessage" class="btn btn-primary mb-3 p-2" onclick="toggleMessages()">Mostra messaggi</button> --}}
                <div>
                    {{-- Qua sotto va fatto foreach --}}
                    @if (count($messages) > 0)
                        <ul class="list-group list-group-flush">
                            @foreach ($messages as $message)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <h5><strong>Messaggio di {{ $message->surname }} {{ $message->name }}:</strong>
                                            </h5>
                                            <span><i>Scritto il: {{ $message->created_at->format('d M Y') }}</i></span>
                                        </div>
                                        <div class="col-md-6">
                                            <span>{{ $message->message }}</span>
                                        </div>
                                        <div class="col-md-3">
                                            <span><i>Puoi rispondergli scrivendo a: {{ $message->email }}</i></span>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                {{ $messages->links() }}
                            </ul>
                        </nav>
                    @else
                        <h2 class="text-center">Non hai nessun messaggio</h2>
                    @endif
                </div>
            </div>
        </div>



    </div>
@endsection
