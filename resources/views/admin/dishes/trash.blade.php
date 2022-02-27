@extends('layouts.app')

@section('content')
    <section class="trash container">
        <h1>Trashed</h1>
        <table>
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
                @foreach ($trashed as $trash)
                    <tr>
                        <td>
                            {{ $trash->id }}
                        </td>
                        <td>
                            {{ $trash->name }}
                        </td>
                        <td>
                            <a href="{{ route('admin.dishes.restore', $trash->id) }}" class="btn btn-success">Restore</a>
                        </td>
                        <td>
                            <a href="{{ route('admin.dishes.forceDelete', $trash->id) }}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>   
@endsection