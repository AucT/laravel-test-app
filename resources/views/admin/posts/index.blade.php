@extends('admin.app')
@section('content')

    <div class="d-flex justify-content-between mb-3">
        <div></div>
        <a class="btn btn-primary" href="{{ route('admin.posts.create') }}">+ Create</a>
    </div>

    @foreach($items as $post)

        <div class="card mb-3 js-post-{{ $post->id }}" style="width: 28rem;">
            <img src="{{ getFilePath($post->image) }}" class="card-img-top" alt="">
            <div class="card-body">
                <div class="text-secondary mb-2">Author: {{ $post->user->name }}</div>

                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text"> {{ $post->body }}</p>
                <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-primary">Edit</a>
                <button data-adata="&_method=DELETE" data-toggle-hidden=".js-post-{{ $post->id }}" data-confirm="Delete post {{ $post->title }}?" data-url="{{ route('admin.posts.delete', $post->id) }}" class="btn btn-danger js-ajax-button">Delete?</button>
            </div>
        </div>

    @endforeach

    {{ $items->links('vendor.pagination.bootstrap-5') }}
@endsection
