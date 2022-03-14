@extends('layouts.app')

@section('content')
<section>
    <section class="trash container pt-100">
        <h1>Trash</h1>
        @if(!$trashed->isEmpty())
        <table class="table table-hover table-striped table-custom">
            <thead class="thead-brand">
                <tr>
                    <th class="">
                        ID
                    </th>
                    <th  class="">
                        Name
                    </th>
						  <th  class="">
							Price
					  	  </th>
                    <th class="w-thead-brand">
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
								<th>
									{{ $trash_item->price }}€
							   </th>
                        <td class="">
                            <a href="{{ route('admin.dishes.restore', $trash_item->id) }}" class="btn thead-brand"><span class="restore">Restore</span> <i class="fas fa-trash-restore"></i></a>
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