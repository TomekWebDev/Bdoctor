@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h1>Scegli una sponsorizzazione <small class="text-muted">{{ $profile->name }}</small></h1>
                    <div class="dropdown mr-3 align-self-center">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"
                            aria-expanded="false">
                            Action
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.profile.edit', $profile->id) }}">Modifica
                                    Profilo</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.profile.show', $profile->id) }}">Il mio
                                    profilo</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.messages.index', $profile->id) }}">I miei
                                    messaggi</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.sponsors.index', $profile->id) }}">Aggiungi
                                    Sponsor</a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('admin.statistics.index', $profile->id) }}">Statistiche</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        @foreach ($sponsors as $sponsor)
                            <h5>{{ $sponsor->name }}</h1>
                        @endforeach
                    </div>
                </div>



            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div id="dropin-container"></div>
                <button id="submit-button">Request payment method</button>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://js.braintreegateway.com/web/dropin/1.8.1/js/dropin.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        var button = document.querySelector('#submit-button');



        braintree.dropin.create({
            authorization: "sandbox_hc3f74tx_3xs8nqthryqff7r9",
            container: '#dropin-container'

        }, function(createErr, instance) {
            console.log('caricato form per inserimento carte');
            button.addEventListener('click', function() {

                instance.requestPaymentMethod(function(err, payload) {
                    $.get('{{ route('admin.process') }}', {
                        payload
                    }, function(response) {
                        if (response.success) {
                            console.log('Payment successfull!');
                        } else {
                            console.log('Payment failed');
                        }
                    }, 'json');
                });
            });
        });
    </script>
@endpush
