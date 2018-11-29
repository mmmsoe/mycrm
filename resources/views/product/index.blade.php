@extends('layouts/app')

@section('content')
    <div class="container">
        <h3>Product List</h3>

        @if( session('info') )
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif

        <table class="table table-bordered table-striped">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Make</th>
                <th>Model</th>
                <th>#</th>
            </tr>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>
                        <a href="{{ url('products/view/' . $product->id) }}">
                            {{ $product->name }}
                        </a>
                    </td>
                    <td>{{ $product->make }}</td>
                    <td>{{ $product->model }}</td>
                    <td>
                        <a href="{{ url('products/edit/' . $product->id) }}">Edit</a> |
                        <a href="{{ url('products/delete/' . $product->id) }}">Delete</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
