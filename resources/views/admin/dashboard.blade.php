@extends('layouts.app')



@section('content')
    <div>
        CIAOOOOOOOOOOOO Dashboard!
    </div>
    {{-- @if (session('alreadyCreated'))
        <div>{{ session('alreadyCreated') }}</div>
    @endif

    @if (!$profile_id)

    @endif --}}

    <a href="{{ route('admin.profile.create') }}">vai a create</a>

    <a href="{{ route('admin.profile.edit', $profile->id) }}">Vai a edit</a>

    <a href="{{ route('admin.profile.show', $profile->id) }}">Vai alla show</a>
@endsection
