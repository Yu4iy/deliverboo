@extends('layouts.app')

@section('content')
{{-- @dd($categories[1]) --}}

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
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

                        <div class="form-group row">
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

                        <div class="form-group row">
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

                        <div class="form-group row">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}*</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" autocomplete="new-password" required minlength="8">
                            </div>
                        </div>

                        <div class="form-group row">
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

                        <div class="form-group row">
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

                        <div class="form-group row">
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

                        <div class="form-group row">
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

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                            <div class="col-md-6">
                                <textarea class="form-control" name="description" id="description" cols="30"
                                    rows="10">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">Upload Image </label>

                            <div class="col-md-6">
                                <input type="file" value="{{ old('image') }}" name="image" id="image"
                                    accept="image/png, image/jpeg, image/jpg"><span>png, jpeg, jpg</span>
                            </div>
                        </div>

                        <div class="form-group row">
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

                        <div class="form-group">
                            <label class="col-md-4 col-form-label text-md-right">Categories*</label>
                        </div>
                        <div class="mb-4 text-md-center" id="form-checkbox">
                            @foreach ($categories as $category)
                            <span class="d-inline-block mr-3">
                                <label for="category{{ $loop->iteration }}">{{ $category->name }}</label>
                                <input type="checkbox" name="categories[]" id="category{{ $loop->iteration }}" class="checkbox"
                                    value="{{ $category->id }} " @if ( in_array($category->id, old('categories', [])))
                                checked @endif>
                            </span>
                            @endforeach
                            @error('categories')
                            <span class="text-danger d-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" id="btn-submit">
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
@endsection