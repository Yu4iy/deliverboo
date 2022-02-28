@extends('layouts.app')

@section('content')
{{-- @dd($dishes) --}}
<section class="dishes-menu">
    {{-- @dd($dishes) --}}
    <div class="menu">
        <div class="container">
            <div class="menu-row">
                <div class="menu-row__title">Menu List</div>
                <div class="menu-row__nav">
                    <a href="{{route('admin.dishes.create')}}">Aggiungi</a>
                    <a href="{{ route('admin.dishes.trash') }}">
                        Eliminati di Recente
                        <i class="fa-solid fa-clock-rotate-left"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="container mt-3">
            @if(session()->get('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
            @endif
        </div>

        <div class="menu-items">
            @foreach ($dishes as $dish )
            <div class="menu-item @if(!$dish->is_visible) menu-item_novisible @endif">
                <div class="menu-item__row">
                    <h3 class="menu-item__title">{{$dish->name}}</h3>
                    <div class="menu-item__nav d-flex">
                        <a href="{{route('admin.dishes.edit', $dish->id)}}">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                            <form action="{{ route('admin.dishes.destroy', $dish->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn" type="submit" 
                                    onclick="return confirm('Vuoi spostare questo elemento nel cestino?')">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                    </div>
                </div>
                <div class="menu-main">
                    <ul class="menu-main__desc">
                        <li><strong>Ingridients: </strong>{{$dish->ingredients}}</li>
                        <li><strong>Prezzo: </strong>{{$dish->price}}&#8364;</li>
                        <li><strong>Visibile: </strong>@if($dish->is_visible) <span class="text-success">Si</span> @else  <span class="text-danger" >No</span> @endif</li>
                        <li><strong>Descrizione: </strong>@if($dish->description) {{$dish->description}} @else
                            aggiungere descrizione @endif</li>
                    </ul>
                    <div class="menu-main__img">
                        @if($dish->image)
                        <img class="img-fluid" src="{{ asset('storage/' . $dish->image) }}" alt="{{$dish->name}}">
                        @endif
                    </div>
                    <!-- <div class="menu-main__img">
								@if($dish->image)
								<img class="img-fluid" src="{{$dish->image}}" alt="{{$dish->name}}">
								@endif
							</div> -->
                </div>
            </div>
            @endforeach



        </div>
    </div>



    {{-- <h1 class="mb-4">My Menu</h1>

            <table class="w-100">
                <thead class="mb-3">
                    <tr>
                        <td>
                            ID
                        </td>
                        <td>
                            Name
                        </td>
                        <td colspan="3">
                            Actions
                        </td>
                    </tr>
                </thead>
    
                <tbody>
                    @foreach ($dishes as $dish )
                        <tr class="mb-2">
                            <td>
                                {{ $dish->id }}
    </td>
    <td>
        {{ $dish->name }}
    </td>
    <td>
        <a href="{{ route('admin.dishes.show', $dish->slug) }}" class="btn btn-success">Show</a>
    </td>
    <td>
        <a href="{{ route('admin.dishes.edit', $dish->id) }}" class="btn btn-primary">Edit</a>
    </td>
    <td>
        <form action="{{ route('admin.dishes.destroy', $dish->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" type="submit">Delete</button>
        </form>
    </td>
    </tr>
    @endforeach
    </tbody>
    </table>--}}
</section>
@endsection