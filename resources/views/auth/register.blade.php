@extends('layouts.app')

@section('content')
{{-- @dd($categories[1]) --}}
<div class="container-fluid pt-100 registerContainer">
    <div class="row justify-content-center pb-5">
        <div class=" col-md-8 mb-5">
            <div class="card ">
                <div class="cardHeader">{{ __('Register') }}</div>

                <div class="card-body mt-5">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row mb-4">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}*</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" autocomplete="name" autofocus required
                                    maxlength="255">

                                @error('name')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}*</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" autocomplete="email" required>

                                @error('email')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-right">{{ __('Password') }}*</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    autocomplete="new-password" required minlength="8">

                                @error('password')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}*</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" autocomplete="new-password" required minlength="8">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="restaurant_name" class="col-md-4 col-form-label text-md-right">Restaurant
                                Name*</label>

                            <div class="col-md-6">
                                <input id="restaurant-name" type="text" value="{{ old('restaurant_name') }}"
                                    class="form-control @error('restaurant_name') is-invalid @enderror"
                                    name="restaurant_name" required maxlength="50">
                                @error('restaurant_name')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group row mb-4">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Address*</label>

                            <div class="col-md-6">
                                <input id="address" type="text" value="{{ old('address') }}"
                                    class="form-control @error('address') is-invalid @enderror" name="address">
                                @error('address')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group row mb-4">
                            <label for="city" class="col-md-4 col-form-label text-md-right">City*</label>

                            <div class="col-md-6">
                                <input id="city" type="text" value="{{ old('city') }}"
                                    class="form-control @error('city') is-invalid @enderror" name="city" required
                                    maxlength="50">
                                @error('city')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group row mb-4">
                            <label for="iva" class="col-md-4 col-form-label text-md-right">IVA*</label>

                            <div class="col-md-6">
                                <input id="iva" type="tel" pattern="[0-9]{11}" value="{{ old('iva') }}"
                                    class="form-control @error('iva') is-invalid @enderror" name="iva" required>
                                @error('iva')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group row mb-5">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                            <div class="col-md-6">
                                <textarea class="form-control" name="description" id="description" cols="30"
                                    rows="10">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="image" class="col-md-4 col-form-label text-md-right">Upload Image </label>

                            <div class="col-md-6">
                                <input type="file" value="{{ old('image') }}" name="image" id="image"
                                    accept="image/png, image/jpeg, image/jpg"><span>png, jpeg, jpg</span>
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <label for="delivery_price" class="col-md-4 col-form-label text-md-right">Delivery
                                Price*</label>
                            <div class="col-md-6">
                                <input id="delivery_price" type="number" value="{{ old('delivery_price') }}" min=0
                                    step="0.01" class="form-control @error('delivery_price') is-invalid @enderror"
                                    name="delivery_price" required>
                                @error('delivery_price')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            {{-- @foreach ($categories as $category)
										 <h1>{{$category->name}}</h1>
                            @endforeach --}}

                        </div>

                        <div class="form-group row mb-5" id="form-checkbox">
                            <label class="col-md-4 col-form-label text-md-right">Categories*</label>
                            <ul class="col-md-8 col-lg-7 row">
                                @foreach ($categories as $category)     
                                <li class="pt-2 categorylist col-sm-4 col-md-6 col-lg-4">
                                    
                                    <input 
                                        type="checkbox"
                                        name="categories[]" 
                                        id="category{{ $loop->iteration }}" 
                                        class="checkbox px-2"
                                        value="{{ $category->id }} " 
                                        @if ( in_array($category->id, old('categories', [])))
                                        checked 
                                        @endif
                                    >
                                    <label  for="category{{ $loop->iteration }}">{{ $category->name }}</label>
                                </li>                  
                                    
                                @endforeach
                            </ul>
                            @error('categories')
                            <div class="text-danger d-block">
                                <p>{{ $message }}</p>
                            </div>
                            @enderror
                        </div>

                        <div class="form-group row mb-5 mt-3 justify-content-center">
                            <div class="col-sm-3 col-md-3 col-lg-2 ">
                                <button type="submit" class="RegButton" id="btn-submit">
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

@section('scripts')
<script src="{{ asset('js/checkbox-validation.js') }}" defer></script>
<script src="{{ asset('js/useful-functions.js') }}" defer></script>
@endsection



