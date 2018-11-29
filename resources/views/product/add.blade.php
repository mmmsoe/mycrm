@extends('layouts/app')

@section('content')
    <div class="container">
        <h3>Add New Product</h3>

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
                <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label>Make</label>
                <input type="text" name="make" class="form-control">
            </div>
            <div class="form-group">
                <label>Model</label>
                <input type="text" name="model" class="form-control">
            </div>

            <input type="submit" value="Add Product" class="btn btn-primary">
        </form>
    </div>
@endsection
