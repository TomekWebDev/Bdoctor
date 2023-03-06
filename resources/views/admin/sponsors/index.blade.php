@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h3>Scegli una sponsorizzazione</h3>
                    <div class="dropdown align-self-center">
                        <button class="btn btn-secondary dropdown-toggle" style="background-color: #076dbb" type="button"
                            data-toggle="dropdown" aria-expanded="false">
                            Action
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right dropdown-menu-lg-right">
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.profile.edit', $profile->id) }}">Modifica
                                    Profilo</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.profile.show', $profile->id) }}">Il mio
                                    profilo</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.messages.index', $profile->id) }}">I miei
                                    messaggi</a>
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

                <div class="card mt-2 p-2">
                    {{-- <img src="../../imgA/bronze.png" class="card-img-top" alt="..."> --}}
                    <div class="card-body">
                        <h1 class="card-title" style="color: #cd7f32; ">{{ $bronze->name }}</h1>
                        <h5 class="card-text">Il tuo profilo comparirà nella Homepage del sito per 24 ore!</h5>
                        @if (!$last_expiration_date)
                            <div class="container alert alert-success">
                                <div class="row">
                                    <span>
                                        <small>Hai una sponsorizzazione attiva con scadenza:</small>
                                    </span>

                                    <span>
                                        {{ date('d M Y - g:i A', strtotime($last_expiration_date)) }}
                                    </span>
                                </div>
                                <div class="row">
                                    <span>
                                        <small>Nuova scadenza aggiornata a seguito dell'acquisto:</small>
                                    </span>
                                    <span>
                                        {{ $expiration_date_bronze_simulation }}
                                    </span>
                                </div>
                            </div>
                        @endif


                        <a href="{{ route('admin.sponsor.pay', $bronze->name, $profile->name) }}"
                            class="btn btn-primary my-2" style="background-color: #076dbb">Acquista {{ $bronze->name }}
                        </a>
                    </div>
                </div>

                <div class="card mt-2 p-2">
                    {{-- <img src="../../imgA/bronze.png" class="card-img-top" alt="..."> --}}
                    <div class="card-body">
                        <h1 class="card-title" style="color: #c0c0c0; ">{{ $silver->name }}</h1>
                        <h5 class="card-text">Il tuo profilo comparirà nella Homepage del sito per 48 ore!</h5>

                        <div class="container alert alert-success">
                            <div class="row">
                                <span>
                                    <small>Hai una sponsorizzazione attiva con scadenza:</small>
                                </span>

                                <span>
                                    {{ date('d M Y - g:i A', strtotime($last_expiration_date)) }}
                                </span>
                            </div>
                            <div class="row">
                                <span>
                                    <small>Nuova scadenza aggiornata a seguito dell'acquisto:</small>
                                </span>
                                <span>
                                    {{ $expiration_date_silver_simulation }}
                                </span>
                            </div>
                        </div>
                        <a href="{{ route('admin.sponsor.pay', $silver->name, $profile->name) }}"
                            class="btn btn-primary my-2" style="background-color: #076dbb">Acquista {{ $silver->name }}

                        </a>
                    </div>
                </div>

                <div class="card mt-2 p-2">
                    {{-- <img src="../../imgA/bronze.png" class="card-img-top" alt="..."> --}}
                    <div class="card-body">
                        <h1 class="card-title" style="color: #d4af37; ">{{ $gold->name }}</h1>
                        <h5 class="card-text">Il tuo profilo comparirà nella Homepage del sito per 72 ore!</h5>

                        <div class="container alert alert-success">
                            <div class="row">
                                <span>
                                    <small>Hai una sponsorizzazione attiva con scadenza:</small>
                                </span>

                                <span>
                                    {{ date('d M Y - g:i A', strtotime($last_expiration_date)) }}
                                </span>
                            </div>
                            <div class="row">
                                <span>
                                    <small>Nuova scadenza aggiornata a seguito dell'acquisto:</small>
                                </span>
                                <span>
                                    {{ $expiration_date_gold_simulation }}
                                </span>
                            </div>
                        </div>
                        <a href="{{ route('admin.sponsor.pay', $gold->name, $profile->name) }}"
                            class="btn btn-primary my-2" style="background-color: #076dbb">Acquista {{ $gold->name }}

                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
