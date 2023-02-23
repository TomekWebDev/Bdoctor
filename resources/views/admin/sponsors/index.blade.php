@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h1>Scegli una sponsorizzazione <small class="text-muted">{{ $profile->name }}</small></h1>
                    <div class="dropdown mr-3 align-self-center">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"
                            aria-expanded="false">
                            Action
                        </button>
                        <ul class="dropdown-menu">
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
                <div class="card mt-3">
                    <div class="card-body">
                            <a href="{{ route('admin.sponsor.pay', $bronze->name) }}">{{ $bronze->name }}</a>
                            <a href="{{ route('admin.sponsor.pay', $silver->name) }}">{{ $silver->name }}</a>
                            <a href="{{ route('admin.sponsor.pay', $gold->name) }}">{{ $gold->name }}</a>
                    </div>
                </div>



            </div>
        </div>
    </div>
    
@endsection

