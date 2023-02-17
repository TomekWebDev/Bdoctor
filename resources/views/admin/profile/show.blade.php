@extends('layouts.app')

@section('content')
    <div>questa è la show del dottore</div>

    <div>{{ $this_user->name }}</div>
    <div>{{ $this_user->surname }}</div>
    <div>{{ $this_profile->city }}</div>

    <a href="{{ route('admin.profile.edit', $this_profile->id) }}">Vai a edit</a>
@endsection
