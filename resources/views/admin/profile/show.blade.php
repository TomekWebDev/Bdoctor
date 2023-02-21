@extends('layouts.app')

@section('content')

    <div class="container">
        
        <div class="row">

            <div class="col-sm-4">
                <div class="card mt-3">
                    <div class="card-body">
                        @if ($this_profile->image)
                            <img src="{{ asset("Storage/$this_profile->image") }}" class="img-fluid">
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
                        <div>{{ $this_user->name }}</div>
                        <div>{{ $this_user->surname }}</div>
                        <div>{{ $this_profile->city }}</div>
                        <div>{{ $this_profile->address }}</div>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <embed src="{{ asset("Storage/$this_profile->resume") }}" class="img-fluid w-100 h-100"
                        type='application/pdf' />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
