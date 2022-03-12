@extends('layouts.app')

@section('content')
<section class="sfContainer">
    <section class="trash container pt-100">
        <h1>Trash</h1>
        @if(!$trashed->isEmpty())
        <table class="table">
            <thead>
                <tr>
                    <th>
                        ID
                    </th>
                    <th>
                        Name
                    </th>
                    <th colspan="2">
                        Actions
                    </th>
                </tr>
            </thead>
				
            <tbody>
                @foreach ($trashed as $trash_item)
                    <tr>
                        <td>
                            {{ $trash_item->id }}
                        </td>
                        <td>
                            {{ $trash_item->name }}
                        </td>
                        <td>
                            <a href="{{ route('admin.dishes.restore', $trash_item->id) }}" class="btn btn-success">Restore</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <h4>Il cestino è vuoto</h4>
        @endif
    </section>  
</section>
 
@endsection