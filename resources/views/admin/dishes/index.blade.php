@extends('layouts.app')

@section('content')
    <section class="dishes-menu">
        
        <div class="container">
            <h1 class="mb-4">My Menu</h1>

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
            </table>
        </div>
    </section>
@endsection