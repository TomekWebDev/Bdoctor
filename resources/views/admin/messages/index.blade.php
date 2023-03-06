@extends('layouts.app')

@section('content')


    <div class="container">


        {{-- MESSAGGI --}}
        <div class="card mt-4 text-center mb-3">
            <div class="d-flex justify-content-between p-3">
                <h3 class="mt-3">Messaggi ricevuti</h3>
                <div class="dropdown d-flex flex-row-reverse align-self-center">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"
                        aria-expanded="false" style="background-color: #076dbb">
                        Menu
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right dropdown-menu-lg-right">
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.index', $profile->id) }}">Dashboard</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.profile.edit', $profile->id) }}">Modifica
                                Profilo</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.reviews.index', $profile->id) }}">Le mie
                                Recensioni</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.sponsors.index', $profile->id) }}">Aggiungi
                                Sponsor</a>
                        </li>
                        <li>
                            <a class="dropdown-item"
                                href="{{ route('admin.statistics.index', $profile->id) }}">Statistiche</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card-body">
                {{-- <button id="buttonMessage" class="btn btn-primary mb-3 p-2" onclick="toggleMessages()">Mostra messaggi</button> --}}
                <div>
                    {{-- Qua sotto va fatto foreach --}}
                    @if (count($messages) > 0)
                        @foreach ($messages as $message)
                            <div class="card my-3 col-lg-6 mx-lg-auto">
                                <div class="card-body text-left">
                                    <h5 class="card-title">{{ $message->surname }} {{ $message->name }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $message->email }}</h6>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $message->created_at->format('d M Y') }}
                                    </h6>
                                    <div class="dropdown-divider"></div>
                                    <p class="card-text mt-1">{{ $message->message }}</p>
                                    <a class="btn btn-success btn-sm text float-right" target="_blank"
                                        href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $message->email }}">Rispondi</a>
                                </div>
                            </div>
                        @endforeach
                        </ul>
                    @else
                        <h2 class="text-center">Non hai nessun messaggio</h2>
                    @endif
                </div>
            </div>
        </div>
        <div class="w-100 d-flex justify-content-center">
            <nav aria-label="">
                <ul class="pagination">
                    {{ $messages->links() }}
                </ul>
            </nav>
        </div>




    </div>
@endsection
