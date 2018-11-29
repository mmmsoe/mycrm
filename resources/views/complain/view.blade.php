@extends('layouts/app')

@section('content')
    <div class="container">

        @if(session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-8">
                <div class="{{ config('crm.card')[$complain->status] }}">
                    <div class="card-header">
                        <b><i class="fas fa-bug"></i> {{ $complain->subject }}</b>
                    </div>
                    <div class="card-body">
                        {{ $complain->detail }}
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6">
                                {{ $complain->created_at->diffForHumans() }}
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ url("complains/status/$complain->id/4") }}" class="btn btn-link">Close</a>
                                <a href="#" class="btn btn-primary"><i class="fas fa-edit"></i> Edit</a>
                                <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br>
                <h5>Comments</h5>
                <hr>
                <div class="comments">
                    @foreach($complain->comments as $comment)
                        <div class="card card-default">
                            <div class="card-header">
                                <i class="fas fa-user"></i> {{ $comment->user->name }}
                                <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>

                                <a href="{{ url('comments/delete/' . $comment->id) }}" style="float:right">
                                    <i class="fas fa-times-circle"></i>
                                </a>
                            </div>
                            <div class="card-body">
                                {{ $comment->comment }}
                            </div>
                        </div><br>
                    @endforeach

                    <form action="{{ url('comments/add') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="complain_id" value="{{ $complain->id }}">
                        <textarea name="comment" class="form-control" placeholder="New Comment"></textarea><br>
                        <input type="submit" value="Add Comment" class="btn btn-primary">
                    </form>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-md-4">
                <div class="card card-default">
                    <div class="card-header dropdown" >
                        <b class="dropdown-toggle" data-toggle="dropdown"><i class="fas fa-user"></i> Assigned To</b>

                        <div class="dropdown-menu">
                            @foreach($users as $user)
                                <a href="{{ url("complains/assign/$complain->id/$user->id") }}" class="dropdown-item">
                                    {{ $user->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-body">
                        <b>{{ $complain->user->name }}</b>
                        ({{ config('crm.role')[$complain->user->role] }})
                    </div>
                    <div class="card-footer">
                        <div class="dropdown">
                            <button class="btn btn-dark dropdown-toggle" data-toggle="dropdown" >{{ config('crm.status')[$complain->status] }}</button>
                            <div class="dropdown-menu">
                                @foreach(config('crm.status') as $index => $status)
                                    <a class="dropdown-item" href="{{ url("complains/status/$complain->id/$index") }}">
                                        {{ $status }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="card card-default">
                    <div class="card-header">
                        <b><i class="fas fa-users"></i> Customers</b>
                    </div>
                    <div class="card-body">
                        <b>{{ $complain->customer->name }}</b>
                        <div>P: {{ $complain->customer->phone }}</div>
                        <div>E: {{ $complain->customer->email }}</div>
                    </div>
                    <div class="card-footer">
                        <small>{{ $complain->customer->address }}</small>
                    </div>
                </div>
                <br>
                <div class="card card-default">
                    <div class="card-header">
                        <b><i class="fas fa-mobile"></i> Product</b>
                    </div>
                    <div class="card-body">
                        <b>{{ $complain->product->name }}</b>
                        <div>Make: {{ $complain->product->make }}</div>
                        <div>Model: {{ $complain->product->model }}</div>
                    </div>
                </div>
                <br>
                <div class="card card-default">
                    <div class="card-body">
                        <ul>
                            @foreach($complain->logs as $log)
                                <li>{{ $log->content }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
