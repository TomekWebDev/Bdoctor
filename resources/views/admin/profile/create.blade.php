@extends('layouts.app')

{{-- da linkare a seguito del refgister --}}

@section('content')
    <div>Questa è la create del profile</div>


    <form enctype="multipart/form-data" method="POST" action="{{ route('admin.profile.store') }}" class="mx-5 my-3">

        @csrf

        <div class="mb-3">
            <label class="form-label">City</label>
            <input name="city" type="string" class="form-control">

        </div>

        <div class="mb-3">
            <label class="form-label">Address</label>
            <input name="address" type="string" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input name="phone" type="string" class="form-control">
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
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Services</label>
            <textarea name="services" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Tags</label>

            @foreach ($specs as $spec)
                <label for="">
                    <input type="checkbox" name="specs[]" value="{{ $spec->id }}">
                    {{ $spec->name }}
                </label>
            @endforeach

        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
