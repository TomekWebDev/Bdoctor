@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">

        <div class="col-sm-4">
            <div class="card mt-3">
                <div class="card-body">
                    @if ($this_profile->image)
                    <img src="{{ asset(" Storage/$this_profile->image") }}" class="img-fluid">
                    @else
                    <img src="/img/userDoctor.jpeg" class="img-fluid">
                    @endif

                    <hr>
                    <button type="button" class="btn btn-outline-primary btn-sm btn-block" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        Mostra CV
                    </button>
                </div>
            </div>
        </div>

        <div class="col-sm-8">
            <div class="card mt-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h3>Il mio profilo</h3>
                        <div class="dropdown mr-3">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"
                                aria-expanded="false">
                                Menu
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('admin.profile.edit', $this_profile->id) }}">Modifica Profilo</a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('admin.messages.index', $this_profile->id) }}">Messaggi
                                        ricevuti</a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('admin.reviews.index', $this_profile->id) }}">Le mie
                                        Recensioni</a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('admin.sponsors.index', $this_profile->id) }}">Aggiungi
                                        Sponsor</a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('admin.statistics.index', $this_profile->id) }}">Statistiche</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="dropdown-divider"></div>
                    <div class="text-muted mt-1">Nome: <span class="text-black">{{ $this_user->name }}</span></div>
                    <div class="text-muted mt-1">Cognome: <span class="text-black">{{ $this_user->surname }}</span>
                    </div>
                    <div class="text-muted mt-1">Città: <span class="text-black">{{ $this_profile->city }}</span></div>
                    <div class="text-muted mt-1">Indirizzo: <span class="text-black">{{ $this_profile->address }}</span>
                    </div>
                    <div class="text-muted mt-1">Telefono: <span class="text-black">{{ $this_profile->phone }}</span>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <a class="btn btn-outline-primary btn-sm btn-block"
                        href="{{ route('admin.profile.edit', $this_profile->id) }}">Modifica Profilo</a>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- Modal Curriculum Vitae --}}
<div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Curriculum Vitae</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($this_profile->resume)
                <embed src="{{ asset(" Storage/$this_profile->resume") }}" class="img-fluid w-100 h-100"
                type='application/pdf' />
                <hr>
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-outline-primary btn-sm btn-block"
                            href="{{ route('admin.profile.edit', $this_profile->id) }}">Modifica Profilo</a>
                    </div>
                </div>
                @else
                <h3>Non hai inserito ancora il tuo curriculum</h3>
                <hr>
                <h5>Aggiungi il tuo CV nella pagina Modifica profilo</h5>
                <hr>
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-outline-primary btn-sm btn-block"
                            href="{{ route('admin.profile.edit', $this_profile->id) }}">Modifica Profilo</a>
                    </div>
                </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection
