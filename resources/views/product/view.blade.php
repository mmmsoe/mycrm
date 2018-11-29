@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="card card-default">
            <div class="card-header">
                <b>{{ $product->name }}</b>
            </div>
            <div class="card-body">
                <b>Make: </b> {{ $product->make }}<br>
                <b>Model: </b> {{ $product->model }}
            </div>
        </div>

        <hr>
        <h4>Complains</h4>
        <table class="table table-bordered table-striped">
            <tr>
                <th>ID</th>
                <th>Subject</th>
                <th>Customer</th>
                <th>Status</th>
            </tr>
            @foreach($product->complains as $complain)
                <tr>
                    <td>{{ $complain->id }}</td>
                    <td>{{ $complain->subject }}</td>
                    <td>{{ $complain->customer->name }}</td>
                    <td>
                        <span class="{{ config('crm.badge')[$complain->status] }}">
                            {{ config('crm.status')[$complain->status] }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
