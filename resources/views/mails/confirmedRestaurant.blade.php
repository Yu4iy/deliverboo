<head> 
  <style>
@import url('https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap');
</style>
</head>

<body style="-webkit-tap-highlight-color:transparent; -webkit-text-size-adjust:100%; margin:0; font-family: 'Nunito', sans-serif;">
  <p style="margin-bottom:1rem; margin-top:0">
</p>
<div class="container header" style="margin-left:auto; margin-right:auto; width:100%; padding:15px 0; text-align:center" width="100%" align="center">
        <img src="https://loghi-famosi.com/wp-content/uploads/2021/03/Deliveroo-Logo.png" alt="logo deliveboo" class="logo" style="vertical-align:middle; width:200px" valign="middle" width="200">
</div>
<div class="container" style="margin-left:auto; margin-right:auto; width:100%" width="100%">
        <div class="row" style="display:flex; flex-wrap:wrap">
          <div class="col-12 thanks" style="flex:0 0 auto; width:100%; background-color:#00ccbc; color:#fff; font-size:25px; font-weight:600; padding:30px 0; text-align:center" width="100%" bgcolor="#00ccbc" align="center">Grazie per collaborare con noi!</div>
          <div class="col-12 intro" style="flex:0 0 auto; width:100%; font-size:18px; margin:20px 0" width="100%">
            Ciao <strong style="font-weight:bolder">{{$restaurant->restaurant_name}}</strong>, <br>
            hai un nuovo ordine: <strong>{{$new_order->order_code}}</strong> 
          <div class="col-12 dishes" style="flex:0 0 auto; width:100%; font-size:18px" width="100%">
            Ecco quello che dovrai preparare:
            <table class="table table-striped table-dishes" style="border-collapse:collapse; caption-side:bottom; border-color:#dee2e6; color:#212529; margin-bottom:1rem; vertical-align:top; width:100%; margin:15px 0" valign="top" width="100%">
              <thead style="border-color:inherit; border-style:solid; border-width:0; vertical-align:bottom" valign="bottom">
                <tr style="border-color:inherit; border-style:solid; border-width:0">
                  <th scope="col" style="text-align:-webkit-match-parent; border-color:inherit; border-style:solid; border-width:0" align="-webkit-match-parent">Immagine</th>
                  <th scope="col" style="text-align:-webkit-match-parent; border-color:inherit; border-style:solid; border-width:0" align="-webkit-match-parent">Piatto</th>
                  <th scope="col" style="text-align:-webkit-match-parent; border-color:inherit; border-style:solid; border-width:0" align="-webkit-match-parent">Quantità</th>
                  <th scope="col" style="text-align:-webkit-match-parent; border-color:inherit; border-style:solid; border-width:0" align="-webkit-match-parent">Prezzo</th>
                </tr>
              </thead>
              <tbody style="border-color:inherit; border-style:solid; border-width:0; vertical-align:inherit" valign="inherit">
                @foreach ($new_order->dishes as $dish)
                    <tr style="border-color:inherit; border-style:solid; border-width:0">
                  <th scope="row" style="text-align:-webkit-match-parent; border-color:inherit; border-style:solid; border-width:0" align="-webkit-match-parent">
                    <img src="{{ asset('storage/' . $dish->image) }}" alt="nome piatto" style="vertical-align:middle; width:100px; height:100px" valign="middle">
                  </th>
                  <td style="border-color:inherit; border-style:solid; border-width:0">{{$dish->name}}</td>
                  <td style="border-color:inherit; border-style:solid; border-width:0">{{$dish->pivot->quantity}}</td>
                  <td style="border-color:inherit; border-style:solid; border-width:0">{{$dish->price}}€</td>
                </tr>
                @endforeach           
             </tbody>
            </table>
          </div>
            <div class="col-12 total-amount" style="flex:0 0 auto; width:100%; margin:20px 0 30px 0" width="100%">
            <p style="margin-bottom:1rem; margin-top:0; font-size:18px">Costo totale: <span class="total-amount" style="color:#00ccbc ">{{$new_order->total_price}}€</span> </p>
          </div>
          <div class="col-12 address" style="flex:0 0 auto; width:100%; margin:20px 0 30px 0" width="100%">
            <h4 style="font-weight:500; line-height:1.2; margin-bottom:0.5rem; margin-top:0; font-size:calc(1.275rem + 0.3vw)">
              Indirizzo di spedizione
              <i class="fa-solid fa-person-biking icon" style='-moz-osx-font-smoothing:grayscale; -webkit-font-smoothing:antialiased; font-style:normal; font-variant:normal; line-height:1; text-rendering:auto; font-family:"Font Awesome 6 Free"; font-weight:900; color:#00ccbc; font-size:18px'></i>
            </h4>
            <p style="margin-bottom:1rem; margin-top:0; font-size:18px">{{$new_order->customer_name}}</p>
            <p style="margin-bottom:1rem; margin-top:0; font-size:18px">{{$new_order->customer_lastname}}</p>
            <p style="margin-bottom:1rem; margin-top:0; font-size:18px">{{$new_order->customer_address}}</p>
            <p style="margin-bottom:1rem; margin-top:0; font-size:18px">{{$new_order->customer_phone}}</p>
            <p style="margin-bottom:1rem; margin-top:0; font-size:18px">{{$new_order->customer_email}}</p>
          </div>
          <div class="col-12 close-mail" style="flex:0 0 auto; width:100%; font-size:30px; text-align:center" width="100%" align="center">
            Buon lavoro!
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" style="fill:#00ccbc" width="18", height="18"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M221.6 148.7C224.7 161.3 224.8 174.5 222.1 187.2C219.3 199.1 213.6 211.9 205.6 222.1C191.1 238.6 173 249.1 151.1 254.1V472C151.1 482.6 147.8 492.8 140.3 500.3C132.8 507.8 122.6 512 111.1 512C101.4 512 91.22 507.8 83.71 500.3C76.21 492.8 71.1 482.6 71.1 472V254.1C50.96 250.1 31.96 238.9 18.3 222.4C10.19 212.2 4.529 200.3 1.755 187.5C-1.019 174.7-.8315 161.5 2.303 148.8L32.51 12.45C33.36 8.598 35.61 5.197 38.82 2.9C42.02 .602 45.97-.4297 49.89 .0026C53.82 .4302 57.46 2.303 60.1 5.259C62.74 8.214 64.18 12.04 64.16 16V160H81.53L98.62 11.91C99.02 8.635 100.6 5.621 103.1 3.434C105.5 1.248 108.7 .0401 111.1 .0401C115.3 .0401 118.5 1.248 120.9 3.434C123.4 5.621 124.1 8.635 125.4 11.91L142.5 160H159.1V16C159.1 12.07 161.4 8.268 163.1 5.317C166.6 2.366 170.2 .474 174.1 .0026C178-.4262 181.1 .619 185.2 2.936C188.4 5.253 190.6 8.677 191.5 12.55L221.6 148.7zM448 472C448 482.6 443.8 492.8 436.3 500.3C428.8 507.8 418.6 512 408 512C397.4 512 387.2 507.8 379.7 500.3C372.2 492.8 368 482.6 368 472V352H351.2C342.8 352 334.4 350.3 326.6 347.1C318.9 343.8 311.8 339.1 305.8 333.1C299.9 327.1 295.2 320 291.1 312.2C288.8 304.4 287.2 296 287.2 287.6L287.1 173.8C288 136.9 299.1 100.8 319.8 70.28C340.5 39.71 369.8 16.05 404.1 2.339C408.1 .401 414.2-.3202 419.4 .2391C424.6 .7982 429.6 2.62 433.9 5.546C438.2 8.472 441.8 12.41 444.2 17.03C446.7 21.64 447.1 26.78 448 32V472z"/></svg>
            {{-- <i class="fa-solid fa-utensils icon" style='-moz-osx-font-smoothing:grayscale; -webkit-font-smoothing:antialiased; font-style:normal; font-variant:normal; line-height:1; text-rendering:auto; font-family:"Font Awesome 6 Free"; font-weight:900; color:#00ccbc; font-size:30px'></i> --}}
          </div>
        </div>
      </div> 
     <div class="container footer" style="margin-left:auto; margin-right:auto; width:100%; background-color:#00ccbc; color:#fff; font-weight:500; margin-top:30px; padding:20px" width="100%" bgcolor="#00ccbc">© DeliveBoo 2022 - Team 4</div>

</div>