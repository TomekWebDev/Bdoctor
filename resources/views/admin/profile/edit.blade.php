@extends('layouts.app')

{{-- solita edit + link alla pagina di acquisto sponsor --}}

@section('content')
    {{-- <a href="">Link per andare alla Blade di acquisto degli sponsor</a> --}}

    <div class="container">
        <div class="card mt-3">
            <div class="card-body">

                <div class="d-flex justify-content-between">
                    <h1>Modifica Profilo <small class="text-muted">{{ $user->name }}</small></h1>
                    <div class="dropdown mr-3 align-self-center">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"
                            aria-expanded="false">
                            Action
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right dropdown-menu-lg-right">
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.index', $profile_to_edit->id) }}">Dashboard</a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('admin.messages.index', $profile_to_edit->id) }}">Messaggi ricevuti</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.reviews.index', $profile_to_edit->id) }}">Le
                                    mie Recensioni</a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('admin.sponsors.index', $profile_to_edit->id) }}">Aggiungi Sponsor</a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('admin.statistics.index', $profile_to_edit->id) }}">Statistiche</a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <form id="myForm" enctype="multipart/form-data" method="POST"
                    action="{{ route('admin.profile.update', $profile_to_edit->id) }}" class="mx-3 my-3">

                    @csrf
                    @method('PUT')


                    <div class="mb-3">
                        <label class="form-label"><span class="text-danger">*</span> City</label>
                        <input required name="city" type="string"
                            class="form-control @error('city') is-invalid @enderror" value="{{ $profile_to_edit->city }}">

                        @error('city')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><span class="text-danger">*</span> Address</label>
                        <input required name="address" type="string"
                            class="form-control @error('address') is-invalid @enderror"
                            value="{{ $profile_to_edit->address }}">

                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input name="phone" type="string" class="form-control" value="{{ $profile_to_edit->phone }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Resume</label>
                        <input name="resume" type="file" class="form-control"
                            placeholder="{{ $profile_to_edit->resume }}">

                    </div>

                    <div class="mb-3">
                        <label class="form-label">Profile image</label>
                        <input name="image" type="file" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control">{{ $profile_to_edit->description }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Services</label>
                        <textarea name="services" class="form-control">{{ $profile_to_edit->services }}</textarea>
                    </div>

                    <div class="mb-3">
                        <div class="btn-group dropup">
                            <button class="btn btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown"
                                aria-expanded="false">
                                Specializzazioni
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start overflow-auto" style="height: 200px">
                                @foreach ($specs as $spec)
                                    <li class="@error('specs') is-invalid @enderror">
                                        <input class="form-check-input ml-1" type="checkbox" name="specs[]" value="{{ $spec->id }}" id="{{ $spec->name }}" {{ $profile_to_edit->specs->contains($spec) ? 'checked' : '' }}>
                                        <label class="dropdown-item form-check-label" for="{{ $spec->name }}">{{ $spec->name }}</label>
                                    </li>
                                 @endforeach
                            </ul>
                        </div>
                        <p>
                            <strong id="gatto"></strong>
                        </p>
                        @error('specs')
                            <span class="invalid-feedback" role="alert">
                                <strong>Seleziona almeno una specializzazione!</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3 font-italic">
                        I campi contrassegnati con <span class="text-danger">*</span> sono obbligatori
                    </div>

                    <button type="submit" class="btn btn-primary" id="buttonAbilited">Modifica</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        const myForm = document.getElementById('myForm');
        const checkBoxList = myForm.querySelectorAll('input[type=checkbox]');

        myForm.addEventListener('submit', function(event) {
            const checked = Array.from(checkBoxList).some(checkbox => checkbox.checked);

            if (!checked) {
                event.preventDefault();
                let gatto = document.getElementById('gatto').classList.add('text-danger', 'py-3', 'm-3');
                document.getElementById('gatto').innerText = 'Seleziona almeno una specializzazione!';
            }

        })
    </script>
@endpush
