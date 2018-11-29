@extends('layouts/app')

@section('content')
    <div class="container">

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link @if($status == 'all') active @endif"
                    href="{{ url('complains') }}">
                    <i class="fas fa-list"></i> All
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($status == 'new') active @endif"
                    href="{{ url('complains/filter/new') }}">
                    <i class="fas fa-certificate"></i> New
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fas fa-list-alt"></i> Filter
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Assigned</a>
                    <a class="dropdown-item" href="#">WIP</a>
                    <a class="dropdown-item" href="#">Done</a>
                    <a class="dropdown-item" href="#">Closed</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($status == 'mine') active @endif" href="{{ url('complains/filter/mine') }}">
                    <i class="fas fa-user"></i> Mine
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('complains/add') }}">
                    <i class="fas fa-plus-circle"></i>
                    Add Complain
                </a>
            </li>
        </ul>

        <br>

        <table class="table table-striped table-bordered">
            <tr>
                <th>ID</th>
                <th>Subject</th>
                <th>Product</th>
                <th>Customer</th>
                <th>Status</th>
                <th>Assigned To</th>
            </tr>
            @foreach($complains as $complain)
                <tr>
                    <td>{{ $complain->id }}</td>
                    <td>
                        <a href="{{ url('complains/view/' . $complain->id) }}">
                            {{ $complain->subject }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ url('products/view/' . $complain->product->id) }}">
                            {{ $complain->product->name }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ url('customers/view/' . $complain->customer->id) }}">
                            {{ $complain->customer->name }}
                        </a>
                    </td>
                    <td>
                        <span class="{{ config('crm.badge')[$complain->status] }}">
                            {{ config('crm.status')[$complain->status] }}
                        </span>
                    </td>
                    <td>
                        {{ $complain->user->name or 'none' }}
                    </td>
                </tr>
            @endforeach
        </table>

        {{ $complains->links() }}
    </div>
@endsection
