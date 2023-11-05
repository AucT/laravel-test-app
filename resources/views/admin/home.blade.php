@extends('admin.app')
@section('content')
    <p>Quick Actions</p>

    <div class="row">
        <div class="col-md-3">
            <div class="card mb-3">
                <div class="card-header">Create post</div>
                <div class="card-body">
                    <a class="btn btn-primary" href="{{ route('admin.posts.create') }}">Create post</a>

                </div>
            </div>
        </div>
    </div>

@endsection
