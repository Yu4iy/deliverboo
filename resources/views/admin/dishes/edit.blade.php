@extends('layouts.app')

@section('content')

<section class="dishes-menu">

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
                    <input class="form-control" type="text" id="name" name="name" value="{{old('name', $dish->name)}}">
                    <!-- Visualizzazione mirata per l'errore -->
                    @error('name')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="ingredients" class="form-label">Ingredienti*</label>
                    <input class="form-control" type="text" id="ingredients" name="ingredients"
                        value="{{old('ingredients', $dish->ingredients)}}">
                    <!-- Visualizzazione mirata per l'errore -->
                    @error('ingredients')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Prezzo*</label>
                    <input class="form-control" id="price" type="number" value="{{ old('price', $dish->price) }}" min=0
                        step="0.01" name="price">
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
                    <input type="file" name="image" id="image" class="form-control-file">
                    <!-- Visualizzazione mirata per l'errore -->
                    @error('image')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="is_visible">Il piatto è visibile?</label>
                    <select name="is_visible" id="is_visible" class="form-control mb-4">

                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>


                <button class="btn btn-lightblue" type="submit">Modifica</button>
            </form>
        </div>
</section>
@endsection