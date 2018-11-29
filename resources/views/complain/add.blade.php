@extends('layouts/app')

@section('content')
    <div class="container">
        <h3>New Complain</h3>
        <hr>
        <form method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label>Subject</label>
                <input type="text" name="subject" class="form-control">
            </div>
            <div class="form-group">
                <label>Detail</label>
                <textarea name="detail" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label>Product</label>
                <select id="products" name="product_id" class="form-control">
                    <option value="0">Select Product</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}"
                            data-make="{{ $product->make }}"
                            data-model={{ $product->model }}>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
                <label class="form-text text-muted">
                    Make: <b id="make">N/A</b>, Model: <b id="model">N/A</b>
                </label>
            </div>
            <div class="form-group">
                <label>Customer</label>
                <select id="customers" name="customer_id" class="form-control">
                    <option value="0">Select Customer</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}"
                            data-email="{{ $customer->email }}"
                            data-phone="{{ $customer->phone }}">
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
                <label class="form-text text-muted">
                    Email: <b id="email">N/A</b>, Phone: <b id="phone">N/A</b>
                </label>
            </div>

            <input type="submit" value="Add Complain" class="btn btn-primary">
        </form>
    </div>
@endsection
