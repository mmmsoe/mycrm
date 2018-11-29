@extends('layouts/app')

@section('content')
    <div class="container">
        <h3>Edit Product</h3>

        @if( count($errors) )
            <div class="alert alert-warning">
                @foreach($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif

        <form method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{ $product->name }}">
            </div>
            <div class="form-group">
                <label>Make</label>
                <input type="text" name="make" class="form-control" value="{{ $product->make }}">
            </div>
            <div class="form-group">
                <label>Model</label>
                <input type="text" name="model" class="form-control" value="{{ $product->model }}">
            </div>

            <input type="submit" value="Update Product" class="btn btn-primary">
        </form>
    </div>
@endsection
