@extends('layouts.app')

{{-- solita edit + link alla pagina di acquisto sponsor --}}

@section('content')
    <div>questa è la edit del medico</div>

    <a href="">Link per andare alla Blade di acquisto degli sponsor</a>

    {{-- {{dd($profile_to_edit)}} --}}

    <form id="myForm" enctype="multipart/form-data" method="POST" action="{{ route('admin.profile.update', $profile_to_edit->id) }}" class="mx-5 my-3">

        @csrf
        @method('PUT')


        <div class="mb-3">
            <label class="form-label">City</label>
            <input required name="city" type="string" class="form-control @error('city') is-invalid @enderror" value="{{$profile_to_edit->city}}">

            @error('city')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Address</label>
            <input required name="address" type="string" class="form-control @error('address') is-invalid @enderror" value="{{$profile_to_edit->address}}">

            @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input name="phone" type="string" class="form-control" value="{{$profile_to_edit->phone}}">
        </div>

        <div class="mb-3">
            <label class="form-label">Resume</label>
            <input name="resume" type="file" class="form-control">

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
            <label class="form-label">Specializzazioni</label>

            @foreach ($specs as $spec)
                <label  class="form-label @error('specs') is-invalid @enderror">
                    <input type="checkbox" name="specs[]" value="{{ $spec->id }}" {{ $profile_to_edit->specs->contains($spec) ? 'checked' : '' }}>
                    {{ $spec->name }}
                </label>

            @endforeach
                <p>
                    <strong id="gatto"></strong>
                </p>
            @error('specs')
                <span class="invalid-feedback" role="alert">
                    <strong>Seleziona almeno una specializzazione!</strong>
                </span>
            @enderror

            

        </div>

        <button type="submit" class="btn btn-primary" id="buttonAbilited">Modifica</button>
    </form>
@endsection

@push('script')
    <script>

        const myForm = document.getElementById('myForm');
        const checkBoxList = myForm.querySelectorAll('input[type=checkbox]');

        myForm.addEventListener('submit', function(event){
            const checked = Array.from(checkBoxList).some(checkbox => checkbox.checked);

            if(!checked){
                event.preventDefault();
                let gatto = document.getElementById('gatto').classList.add('text-danger', 'py-3', 'm-3');
                document.getElementById('gatto').innerText = 'Seleziona almeno una specializzazione!';
            }

        })

    </script>
@endpush