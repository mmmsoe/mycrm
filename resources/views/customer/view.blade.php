@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="card card-default">
        {{-- <div class="panel panel-default"> --}}
            <div class="card-header">
                <b>{{ $customer->name }}</b>
            </div>
            <div class="card-body">
                <b>Email: </b> {{ $customer->email }}<br>
                <b>Phone: </b> {{ $customer->phone }}
            </div>
            <div class="card-footer">
                {{ $customer->address }}
            </div>
        </div>

        <hr>
        <h4>Complains</h4>
        <table class="table table-bordered table-striped">
            <tr>
                <th>ID</th>
                <th>Subject</th>
                <th>Product</th>
                <th>Status</th>
            </tr>
            @foreach($customer->complains as $complain)
                <tr>
                    <td>{{ $complain->id }}</td>
                    <td>{{ $complain->subject }}</td>
                    <td>{{ $complain->product->name }}</td>
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
