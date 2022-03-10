@extends('layouts.app')

@section('content')

<section class="dishes-menu pt-50">

    <div class="menu">
        <div class="container">
            <!-- Menu-->
            <div class="menu-row">
                <div class="menu-row__title">
                    Aggiungi un piatto
                </div>
                <div class="menu-row__nav">
                    <a href="{{route('admin.dishes.index')}}">Torna al tuo Menu</a>
                </div>
            </div>
            <!-- Form creazione piatto -->
            <form action="{{ route('admin.dishes.store') }}" method="POST" enctype="multipart/form-data"
                class="mt-4 form-create">
                @csrf
                @method('POST')

                <div class="mb-3">
                    <label for="name" class="form-label">Nome piatto*</label>
                    <input class="form-control" type="text" id="name" name="name" value="{{old('name')}}" required
                        maxlength="50">
                    <!-- Visualizzazione mirata per l'errore -->
                    @error('name')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="ingredients" class="form-label">Ingredienti*</label>
                    <input class="form-control" type="text" id="ingredients" name="ingredients"
                        value="{{old('ingredients')}}" pattern="[a-zA-Z ,]+" required>

                    <!-- Visualizzazione mirata per l'errore -->
                    @error('ingredients')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Prezzo*</label>
                    <input class="form-control" id="price" type="number" value="{{ old('price') }}" step="0.01"
                        name="price" required min="0" max="99999">
                    @error('price')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Descrizione del piatto</label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="5"
                        value="{{old('description')}}">{{old('description')}}</textarea>
                    <!-- Visualizzazione mirata per l'errore -->
                    @error('description')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>

                <!-- Image dish  -->
                <div class="mb-4">
                    <label class="form-label" for="image"> <strong>Immagine del piatto</strong></label>
                    <input type="file" name="image" id="image" class="form-control-file"
                        accept="image/png, image/jpeg, image/jpg"><span>png, jpeg, jpg</span>
                    <!-- Visualizzazione mirata per l'errore -->
                    @error('image')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="is_visible">Il piatto è visibile?</label>
                    <select name="is_visible" id="is_visible" class="form-control">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>


                <button class="btn btn-lightblue" type="submit">Aggiungi</button>
            </form>
        </div>
</section>
@endsection

@section('scripts')
<script src="{{ asset('js/test.js') }}" defer></script>
@endsection