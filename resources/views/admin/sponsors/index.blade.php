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

                <div class="card mt-2 p-2">
                    {{-- <img src="../../imgA/bronze.png" class="card-img-top" alt="..."> --}}
                    <div class="card-body">
                        <h1 class="card-title" style="color: #cd7f32; ">{{ $bronze->name }}</h1>
                        <h5 class="card-text">Il tuo profilo comparirà nella Homepage del sito per 24 ore!</h5>
                        <a href="{{ route('admin.sponsor.pay', $bronze->name, $profile->name) }}"
                            class="btn btn-primary">Buy {{ $bronze->name }} sponsor</a>
                    </div>
                </div>

                <div class="card mt-2 p-2">
                    {{-- <img src="../../imgA/silver.png" class="card-img-top" alt="..."> --}}
                    <div class="card-body">
                        <h1 class="card-title" style="color: #c0c0c0; ">{{ $silver->name }}</h1>
                        <h5 class="card-text">Il tuo profilo comparirà nella Homepage del sito per 48 ore!</h5>
                        <a href="{{ route('admin.sponsor.pay', $silver->name, $profile->name) }}"
                            class="btn btn-primary">Buy {{ $silver->name }} sponsor</a>
                    </div>
                </div>

                <div class="card mt-2 p-2">
                    {{-- <img src="../../imgA/gold.png" class="card-img-top" alt="..."> --}}
                    <div class="card-body">
                        <h1 class="card-title" style="color: #d4af37; ">{{ $gold->name }}</h1>
                        <h5 class="card-text">Il tuo profilo comparirà nella Homepage del sito per 72 ore!</h5>
                        <a href="{{ route('admin.sponsor.pay', $gold->name, $profile->name) }}" class="btn btn-primary">Buy
                            {{ $gold->name }} sponsor</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
