@extends('layouts.app')



@section('content')
   
    <div class="container">
        <div class="card">
            <div class="d-flex align align-items-center">
                <div class="card-body">
                    <h1>Dashboard <small class="text-muted">{{$user->name}}  {{$user->surname}} </small></h1>
                    @foreach ($profile->specs as $spec)
                        <span class="badge bg-primary p-1 m-1">{{ $spec->name }}</span>
                    @endforeach
                </div>

                <div class="btn-group mr-3">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                        Action
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right dropdown-menu-lg-right">
                      <li> 
                        <a class="dropdown-item" href="{{route('admin.profile.edit', $profile->id)}}">Modifica Profilo</a>
                      </li>
                    <li>
                        <a class="dropdown-item" href="{{route('admin.messages.index', $profile->id)}}">Messaggi ricevuti</a>
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
                    <div class="dropdown-divider">
                    </div>
                    <li>
                        <a href="#" class="dropdown-item text-danger" onclick="deleteProfile()">Elimina profilo</a>
                    </li>
                    <form class="d-none" id="activeDelete" action="{{ route('admin.profile.destroy', $profile->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                    </form>
                    </ul>
                </div>
            </div>
        </div>
        {{-- End card --}}

        <div class="row">

            <div class="col-sm-4">
                <div class="card mt-3">
                    <div class="card-body">
                        @if ($profile->image)
                            <img src="{{ asset("Storage/$profile->image") }}" class="img-fluid">
                        @else
                            <img src="/img/userDoctor.jpeg" class="img-fluid">
                        @endif
                        
                        <hr>
                        <button type="button" class="btn btn-outline-primary btn-sm btn-block" data-bs-toggle="modal" data-bs-target="#exampleModal">
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
                        </div>
                        
                        <div class="dropdown-divider"></div>
                        <div class="text-muted mt-1">Nome: <span class="text-black">{{ $user->name }}</span></div>
                        <div class="text-muted mt-1">Cognome: <span class="text-black">{{ $user->surname }}</span></div>
                        <div class="text-muted mt-1">Città: <span class="text-black">{{ $profile->city }}</span></div>
                        <div class="text-muted mt-1">Indirizzo: <span class="text-black">{{ $profile->address }}</span></div>
                        @if ($profile->phone)
                            <div class="text-muted mt-1">Telefono: <span class="text-black">{{ $profile->phone }}</span></div>
                        @endif
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <h2>Statistiche generali</h2>
                        <div class="dropdown-divider"></div>
                        <div class="mt-3">
                            <h5>Totale Recensioni: <small class="text-muted">{{ $review }}</small></h5>
                        </div>
                        <div class="mt-3">
                            <h5>Totale Rating: <small class="text-muted">{{ $rating }}</small></h5>
                        </div>
                        <div class="mt-3">
                            <h5>Totale Messaggi ricevuti: <small class="text-muted">{{ $message }}</small></h5>
                        </div>
                        <div class="mt-3">
                            <h5>La tua sponsorizzazione finirà: <small class="text-muted">{{ $expirationS }}</small></h5>
                        </div>
        
                        <div class="mt-3 p-2 ">
                            <a href="{{ route('admin.statistics.index', $profile->id) }}" class="btn btn-primary">Statistiche</a>
                        </div>
        
                    </div>
                </div>

                <div class="card mt-3 p-2 ">
                    <div class="card-body">
                        <a class="btn btn-outline-primary btn-sm btn-block" href="{{ route('admin.profile.edit', $profile->id) }}">Modifica Profilo</a>
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
                    @if ($profile->resume)
                        <embed src="{{ asset("Storage/$profile->resume") }}" class="img-fluid w-100 h-100" type='application/pdf' />
                        <hr>
                        <div class="card">
                            <div class="card-body">
                                <a class="btn btn-outline-primary btn-sm btn-block" href="{{ route('admin.profile.edit', $profile->id) }}">Modifica Profilo</a>
                            </div>
                        </div>
                    @else
                    <h3>Non hai inserito ancora il tuo curriculum</h3>
                    <hr>
                    <h5>Aggiungi il tuo CV nella pagina Modifica profilo</h5>
                    <hr>
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-outline-primary btn-sm btn-block" href="{{ route('admin.profile.edit', $profile->id) }}">Modifica Profilo</a>
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

@push('script')
 <script>
    function deleteProfile(){
        let alert = confirm( 'sei sicuro di voler cancellare il profilo?');
        if(alert){
            document.querySelector('form#activeDelete').submit();
        }
    }
 </script>
 
    
@endpush


