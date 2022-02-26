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
								<a href="">Ripristina</a>
						</div>		
					</div>			
				</div>
			
				<div class="menu-items">
					@foreach ($dishes as $dish )
					<div class="menu-item">
						<div class="menu-item__row">
							<h3 class="menu-item__title">{{$dish->name}}</h3>
							<div class="menu-item__nav">
								<a href="{{route('admin.dishes.edit', $dish->id)}}"><i class="fa-solid fa-pen-to-square"></i></a>
								<a href=""><i class="fa-solid fa-trash-can"></i></a>
							</div>
						</div>
						<div class="menu-main">
							<ul  class="menu-main__desc">
								<li><strong>Ingridients: </strong>{{$dish->ingredients}}</li>
								<li><strong>Prezzo: </strong>{{$dish->price}}&#8364;</li>
								<li><strong>Disponibile: </strong>@if($dish->price) Si @else No @endif</li>
								<li><strong>Descrizione: </strong>@if($dish->description) {{$dish->description}} @else aggiungere descrizione @endif</li>
							</ul>
							<div class="menu-main__img">
								@if($dish->image)
								<img class="img-fluid" src="{{$dish->image}}" alt="{{$dish->name}}">
								@endif
							</div>
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