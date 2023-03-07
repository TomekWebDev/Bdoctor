<?php
use App\Models\Spec;

$specs = Spec::all();
?>

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right"><span
                                        class="text-danger">*</span> {{ __('Nome') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right"><span
                                        class="text-danger">*</span> {{ __('Cognome') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="surname"
                                        value="{{ old('surname') }}" required autocomplete="name" autofocus>

                                    @error('surname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right"><span
                                        class="text-danger">*</span> {{ __('E-Mail') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Form Password --}}
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right"><span
                                        class="text-danger">*</span> {{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        pattern=".{8,}" required autocomplete="new-password" oninput="validatePassword()">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <p id="password-error" style="display:none; color: red;">La password deve contenere
                                        almeno 8 caratteri.</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right"><span
                                        class="text-danger">*</span> {{ __('Conferma Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                            {{-- form city --}}
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right"><span
                                        class="text-danger">*</span> {{ __('Città') }}</label>

                                <div class="col-md-6">
                                    <input id="city" type="text"
                                        class="form-control @error('city') is-invalid @enderror" name="city"
                                        value="{{ old('city') }}" required autocomplete="city" autofocus>

                                    @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- form address --}}
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right"><span
                                        class="text-danger">*</span> {{ __('Indirizzo') }}</label>

                                <div class="col-md-6">
                                    <input id="address" type="text"
                                        class="form-control @error('address') is-invalid @enderror" name="address"
                                        value="{{ old('address') }}" required autocomplete="address" autofocus>

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row ">
                                <label for="name" class="col-md-4 col-form-label text-md-right"><span
                                        class="text-danger">*</span> Specializzazione</label>
                                <div class="col-md-6">
                                    <select required name="spec_id" id=""
                                        class="form-control @error('spec_id') is-invalid @enderror">
                                        <option value="" disabled selected>Seleziona la tua specializzazione</option>
                                        @foreach ($specs as $spec)
                                            <option value="{{ $spec->id }}">
                                                {{ $spec->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('spec_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>Please select a specialization</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function validatePassword() {
            var password = document.getElementById("password");
            var passwordConfirm = document.getElementById("password-confirm");
            var passwordError = document.getElementById("password-error");

            if (password.value.length < 8) {
                passwordError.style.display = "block";
                password.setCustomValidity("Inserisci almeno 8 caratteri");
            } else if (password.value !== passwordConfirm.value) {
                passwordError.style.display = "none";
                password.setCustomValidity("Le password non corrispondono");
            } else {
                passwordError.style.display = "none";
                password.setCustomValidity("");
            }
        }

        var passwordConfirm = document.getElementById("password-confirm");
        passwordConfirm.addEventListener("input", validatePassword);
    </script>
@endpush
