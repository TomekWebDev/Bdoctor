@extends('layouts.app')



@section('content')
   
    <div class="container">
        <div class="card">
            <div class="d-flex">
                <div class="card-body">
                    <h1>Dashboard <small class="text-muted">{{$user->name}}  {{$user->surname}} con id {{$user->id}}</small></h1>
                </div>

                <div class="dropdown align-self-center mr-3">
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
    </div>
    {{-- @if (session('alreadyCreated'))
        <div>{{ session('alreadyCreated') }}</div>
    @endif

    @if (!$profile_id)

    @endif --}}

    {{-- da togliere --}}
    {{-- <a href="{{ route('admin.profile.create') }}">vai a create</a> --}}

    <div class="container text-center mt-5 border rounded-pill " style="box-shadow: 0px 0px 10px 0px rgb(80, 80, 80)">
        <div class="row">
            <div class="col-12 p-3">
                <h4 class="fs-3 text-capitalize fw-bold">{{$user->name}} {{$user->surname}}</h4>
                <div class="div d-flex flex-wrap mt-2 justify-content-center">
                    @foreach ($profile->specs as $spec)
                        <span class="badge bg-primary m-1">{{ $spec->name }}</span>
                    @endforeach
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


