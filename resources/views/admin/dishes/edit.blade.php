@extends('layouts.app')

@section('content')

<section class="dishes-menu pt-50">

    <div class="menu">
        <div class="container">
            <!-- Menu-->
            <div class="menu-row">
                <div class="menu-row__title">
                    Modifica il piatto: {{$dish->name}}
                </div>
                <div class="menu-row__nav">
                    <a href="{{route('admin.dishes.index')}}">Torna al tuo Menu</a>
                </div>
            </div>
            <!-- Form creazione piatto -->
            <form action="{{ route('admin.dishes.update', $dish->id) }}" method="POST" enctype="multipart/form-data"
                class="mt-4 form-create">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label for="name" class="form-label">Nome piatto*</label>
                    <input class="form-control" type="text" id="name" name="name" value="{{old('name', $dish->name)}}"
                        required maxlength="50">
                    <!-- Visualizzazione mirata per l'errore -->
                    @error('name')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="ingredients" class="form-label">Ingredienti*</label>
                    <input class="form-control" type="text" id="ingredients" name="ingredients"
                        value="{{old('ingredients', $dish->ingredients)}}" pattern="[a-zA-Z ,]+" required>
                    <!-- Visualizzazione mirata per l'errore -->
                    @error('ingredients')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Prezzo*</label>
                    <input class="form-control" id="price" type="number" value="{{ old('price', $dish->price) }}"
                        name="price" required min="0" max="99999" step="0.01">
                    @error('price')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Descrizione del piatto</label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="5"
                        value="{{old('description', $dish->description)}}">{{old('description', $dish->description)}}</textarea>
                    <!-- Visualizzazione mirata per l'errore -->
                    @error('description')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>

                <!-- Image dish  -->
                <div class="mb-4 image-container">
                    <label class="form-label" for="image"> <strong>Immagine del piatto</strong></label>
                    @if($dish->image)
                    <img class="mb-3 edit-iage" width="200" src="{{asset('storage/' . $dish->image)}}"
                        alt="{{$dish->name}}">
                    @endif
                    <input type="file" name="image" id="image" class="form-control-file"
                        accept="image/png, image/jpeg, image/jpg"><span>png, jpeg, jpg</span>
                    <!-- Visualizzazione mirata per l'errore -->
                    @error('image')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="is_visible">Il piatto è visibile?</label>
                    <select name="is_visible" id="is_visible" class="form-control mb-4">
                        <option value="0" {{old('is_visible', $dish->is_visible) == '0' ? 'selected' : ''}}>No</option>
                        <option value="1" {{old('is_visible', $dish->is_visible) == '1' ? 'selected' : ''}}>Si</option>
                    </select>
                </div>


                <button class="btn btn-lightblue" type="submit">Modifica</button>
            </form>
        </div>
</section>
@endsection
@section('scripts')
<script src="{{ asset('js/useful-functions.js') }}" defer></script>
@endsection