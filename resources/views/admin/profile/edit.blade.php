@extends('layouts.app')

{{-- solita edit + link alla pagina di acquisto sponsor --}}

@section('content')
    <div>questa è la edit del medico</div>

    <a href="">Link per andare alla Blade di acquisto degli sponsor</a>

    {{-- {{dd($profile_to_edit)}} --}}

    <form enctype="multipart/form-data" method="POST" action="{{ route('admin.profile.update', $profile_to_edit->id) }}" class="mx-5 my-3">

        @csrf
        @method('PUT')


        <div class="mb-3">
            <label class="form-label">City</label>
            <input name="city" type="string" class="form-control" value="{{$profile_to_edit->city}}">

        </div>

        <div class="mb-3">
            <label class="form-label">Address</label>
            <input name="address" type="string" class="form-control" value="{{$profile_to_edit->address}}">
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
            <label class="form-label">Tags</label>

            @foreach ($specs as $spec)
                <label for="">
                    <input type="checkbox" name="specs[]" value="{{ $spec->id }}" {{ $profile_to_edit->specs->contains($spec) ? 'checked' : '' }}>
                    {{ $spec->name }}
                </label>
            @endforeach

        </div>

        <button type="submit" class="btn btn-primary">Modifica</button>
    </form>
@endsection
