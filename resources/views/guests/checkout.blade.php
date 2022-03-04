@extends('layouts.app')

@section('content')
<div class="chekcout">
    <div class="container-fluid">
        <h2 class="my-4">Checkout</h2>
        <div class="row ">
            <!-- MAIN  -->
            <div class="col-md-12 col-lg-8 bgr p-5">
                <h4 class="border-bottom py-2">Iserischi datti</h4>
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
                </form>
                <!-- CART -->
                <form action="" id="payment-form" method="POST">
                    @csrf
                    {{-- Braintree --}}  
                        <div id="dropin-container"></div>
                        <button id="submit-button" class="button button--small button--green" type="submit">Purchase</button>
                </form>

            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
{{-- Braintree --}}
<script src="https://js.braintreegateway.com/web/dropin/1.33.0/js/dropin.min.js"></script>
<script src="http://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
<script>
    var button = document.querySelector('#submit-button');
    
    braintree.dropin.create({
      authorization: 'sandbox_g42y39zw_348pk9cgf3bgyw2b',
      selector: '#dropin-container'
    }, function (err, instance) {
      button.addEventListener('click', function () {
        instance.requestPaymentMethod(function (err, payload) {
          // Submit payload.nonce to your server
        });
      })
    });
</script>
@endsection