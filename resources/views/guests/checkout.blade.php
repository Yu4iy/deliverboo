@extends('layouts.app')

@section('content')
<div class="chekcout">
    <div class="container-fluid">
        <h2 class="my-4">Checkout</h2>
        @if (session('success_message'))
            <div class="alert alert-success">
                {{ session('success_message') }}
            </div>
        @endif
        @if (count($errors) > 0))
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error )
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row ">
            <!-- MAIN  -->
            <div class="col-md-12 col-lg-8 bgr p-5">
                <h4 class="border-bottom py-2">Inserisci dati</h4>
                <form class="my-3">
                    <div class="row px-3 py-2 ">
                        <div class="col mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input id="name" type="text" class="form-control" >
                        </div>
                        <div class="col mb-2">
                            <label for="surname" class="form-label">Cognome</label>
                            <input id="surname" type="text" class="form-control" >
                        </div>
                    </div>
                    <div class="row px-3 py-2">
                        <div class="col mb-2">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" class="form-control" >
                        </div>
                        <div class="col mb-3">
                            <label for="phone" class="form-label">Cellulare</label>
                            <input id="phone" type="tel" class="form-control" >
                        </div>
                    </div>
                    <div class="row px-3 py-2">
                        <div class="col mb-2">
                            <label for="adress" class="form-label">Citta - via - numero civico</label>
                            <input id="adress" type="text" class="form-control" >
                        </div>
                    </div>

                    <div class="row px-3 py-2">
                        <div class="mb-3 col">
                            <label for="notes" class="form-label">Informazioni aggiuntive</label>
                            <textarea id="notes" class="form-control" rows="5"></textarea>
                        </div>
                    </div>
                </form> --}}
                <!-- CART -->
                <div>                    
                <form method="post" id="payment-form" action="{{ url('/checkout') }}">
                    @csrf
                    @method('POST')
                    
                    <div class="row px-3 py-2 ">
                        <div class="col mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input id="name" type="text" class="form-control" name="customer_name">
                        </div>
                        <div class="col mb-2">
                            <label for="surname" class="form-label">Cognome</label>
                            <input id="surname" type="text" class="form-control" name="customer_lastname">
                        </div>
                    </div>
                    <div class="row px-3 py-2">
                        <div class="col mb-2">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" class="form-control" name="customer_email">
                        </div>
                        <div class="col mb-3">
                            <label for="phone" class="form-label">Cellulare</label>
                            <input id="phone" type="tel" class="form-control" name="customer_phone">
                        </div>
                    </div>
                    <div class="row px-3 py-2">
                        <div class="col mb-2">
                            <label for="adress" class="form-label">Citta - via - numero civico</label>
                            <input id="adress" type="text" class="form-control" name="customer_address">
                        </div>
                    </div>

                    <div class="row px-3 py-2">
                        <div class="mb-3 col">
                            <label for="notes" class="form-label">Informazioni aggiuntive</label>
                            <textarea id="notes" class="form-control" rows="5" name="notes"></textarea>
                        </div>
                    </div>
                    <section>
                        <label for="amount">
                            <span class="input-label">Totale</span>
                            <div class="input-wrapper amount-wrapper">
                                <input id="amount" name="amount" type="tel" min="1" placeholder="Total" value="10">
                            </div>
                        </label>
    
                        <div class="bt-drop-in-wrapper">
                            <div id="bt-dropin"></div>
                        </div>
                    </section>
    
                    <input id="nonce" name="payment_method_nonce" type="hidden" />
                    <button class="button" type="submit"><span>Completa il pagamento</span></button>

                    <Cart><Cart/>
                </form>

            </div>

        </div>
    </div>
</div>

{{-- <script src="https://js.braintreegateway.com/web/dropin/1.33.0/js/dropin.min.js"></script>
    <script>
        var form = document.querySelector('#payment-form');
        var client_token = '{{ $token }}';

        braintree.dropin.create({
          authorization: client_token,
          selector: '#bt-dropin',
          paypal: {
            flow: 'vault'
          }
        }, function (createErr, instance) {
          if (createErr) {
            console.log('Create Error', createErr);
            return;
          }
          form.addEventListener('submit', function (event) {
            event.preventDefault();

            instance.requestPaymentMethod(function (err, payload) {
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
    </script> --}}
@endsection

@section('scripts')
<script src="https://js.braintreegateway.com/web/dropin/1.33.0/js/dropin.min.js"></script>
<script defer>
    var form = document.querySelector('#payment-form');
    var client_token = '{{ $token }}';

    braintree.dropin.create({
      authorization: client_token,
      selector: '#bt-dropin',
      paypal: {
        flow: 'vault'
      }
    }, function (createErr, instance) {
      if (createErr) {
        console.log('Create Error', createErr);
        return;
      }
      form.addEventListener('submit', function (event) {
        event.preventDefault();

        instance.requestPaymentMethod(function (err, payload) {
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
@endsection