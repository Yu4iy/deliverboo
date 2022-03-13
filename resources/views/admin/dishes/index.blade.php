@extends('layouts.app')

@section('content')

<section class="dishes-menu sfContainer">

    <div class="menu">
        <div class="container pt-50">
            <div class="menu-row">
                <div class="menu-row__title">Menu List</div>
                <div class="menu-row__nav">
                    <a href="{{route('admin.dishes.create')}}">
							<span class="mobile-dash">Aggiungi</span>
							<i class="fas fa-plus"></i></a>
                    <a href="{{ route('admin.dishes.trash') }}">
								<span class="mobile-dash">Eliminati di Recente</span>
                        <i class="fa-solid fa-clock-rotate-left"></i>
                    </a>
                    <a href="{{ route('admin.home') }}">
                        <span class="mobile-dash">Dashboard</span>
                        <i class="fa-solid fa-briefcase"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="container mt-3">
            @if(session()->get('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
            	@elseif (session()->get('message-edit'))
                <div class="alert alert-success">
                    <strong>{{session('message-edit')}}</strong> modificato con successo.
                </div>
                @elseif (session()->get('message-restore'))
                <div class="alert alert-success">
                    {{ session()->get('message-restore') }}
                </div>
                @elseif (session()->get('deleted'))
                <div class="alert alert-danger">
                    <strong>{{session('deleted')}}</strong> eliminato con successo.
                </div>
                @endif
        </div>


        <div class="menu-items">
            @if ($dishes->isEmpty())
            <div class="menu-empty">
                <p>Non ci sono ancora piatti nel tuo menu!
                    <i class="fa-solid fa-utensils icon-empty"></i>
                </p>
            </div>
            @else
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
    @endif
</section>
@endsection