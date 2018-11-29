@extends('layouts/app')

@section('content')
    <div class="container">
        <h3>Add New Customer</h3>

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
                <label>Email</label>
                <input type="text" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control">
            </div>
            <div class="form-group">
                <label>Address</label>
                <textarea name="address" class="form-control"></textarea>
            </div>

            <input type="submit" value="Add Customer" class="btn btn-primary">
        </form>
    </div>
@endsection
