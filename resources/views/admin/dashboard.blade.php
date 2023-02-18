@extends('layouts.app')



@section('content')
    <div>
        <h4 class="mb-5">CIAOOOOOOOOOOOO Dashboard dello user: {{ $user->name }} con id: {{ $user->id }}</h4>
    </div>
    {{-- @if (session('alreadyCreated'))
        <div>{{ session('alreadyCreated') }}</div>
    @endif

    @if (!$profile_id)

    @endif --}}

    {{-- da togliere --}}
    <a href="{{ route('admin.profile.create') }}">vai a create</a>


    <a href="{{ route('admin.profile.edit', $profile->id) }}">Vai a edit</a>

    <a href="{{ route('admin.profile.show', $profile->id) }}">Vai alla show</a>

    <a href="{{ route('admin.messages.index', $profile->id) }}">Vai ai messaggi</a>

    <a href="">Vai ad acquisto sponsor</a>
@endsection
