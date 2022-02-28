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
                        <button class="btn" type="submit" data-toggle="modal" data-target="#exampleModal">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>

                    </div>
                </div>
                <div class="menu-main">
                    <ul class="menu-main__desc">
                        <li><strong>Ingridients: </strong>{{$dish->ingredients}}</li>
                        <li><strong>Prezzo: </strong>{{$dish->price}}&#8364;</li>
                        <li><strong>Visibile: </strong>@if($dish->is_visible) <span class="text-success">Si</span> @else
                            <span class="text-danger">No</span> @endif
                        </li>
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
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cestina</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="x">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Vuoi spostare questo elemento nel cestino?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <form action="{{ route('admin.dishes.destroy', $dish->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-delete" type="submit">
                            Si
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection