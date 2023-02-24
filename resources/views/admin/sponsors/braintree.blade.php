{{-- <!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pagamento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head> --}}

@extends('layouts.app')





{{-- <body> --}}
@section('content')
    <div class="container">


        <div class="card mt-3">
            <div class="card-body">

                <div class="d-flex justify-content-between">
                    <h1>Benvenuto nella pagina di checkout</h1>
                    <a href="{{ route('admin.index') }}" class="btn btn-secondary align-self-center" type="button">
                        Dashboard
                    </a>
                </div>

            </div>
        </div>

        <div class="container">
            @if (session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger mt-3">
                    {{ session('error') }}
                </div>
            @endif

        </div>

        <div class="w-50 mx-auto">
            <form method="POST" id="payment-form" action="{{ route('admin.sponsors.checkout', $type->price) }}">

                @csrf
                <h1 class="text-center">Hai scelto la versione: <span>{{ $type->name }}</span></h1>
                <section class="mt-6 mb-3">
                    <label class="d-flex">
                        <span>Prezzo:</span>
                        <span>{{ $type->price }} € </span>
                    </label>

                    <div>
                        <div id="bt-dropin"></div>
                    </div>
                </section>

                <input id="nonce" name="payment_method_nonce" type="hidden" />
                <div class="d-flex justify-content-center">
                    <button class="btn btn-primary" type="submit"><span>Paga Ora</span></button>
                </div>

            </form>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://js.braintreegateway.com/web/dropin/1.33.1/js/dropin.min.js"></script>
    <script>
        let form = document.querySelector('#payment-form');
        let client_token = "{{ $token }}";
        braintree.dropin.create({
            authorization: client_token,
            selector: '#bt-dropin',
        }, function(createErr, instance) {
            if (createErr) {
                console.log('Create Error', createErr);
                return;
            }
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                let button = document.querySelector('button');
                button.disabled = true;
                instance.requestPaymentMethod(function(err, payload) {
                    if (err) {
                        console.log('Request Payment Method Error', err);
                        return;
                    }
                    // Add the nonce to the form and submit
                    document.querySelector('#nonce').value = payload.nonce;
                    form.submit();
                });
            });
        });
    </script>
@endpush

{{--    script braintree --}}

{{-- </body> --}}

</html>
