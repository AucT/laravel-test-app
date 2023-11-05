@extends('admin.app')
@section('content')


    <div class="d-flex justify-content-between">
        <div></div>
        <form onsubmit="return confirm('Delete post?')" action="{{ route('admin.posts.delete', $post->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Delete</button>
        </form>

    </div>

    <div class="card" style="max-width: 600px">
                <div class="card-header">{{ __('Create Post') }}</div>

                <div class="card-body">

                    <div id="image-container">
                        <img src="{{ $post->image }}" alt="">
                    </div>

                    <form action="{{ route('admin.posts.image.update', $post->id) }}" method="POST"  class="js-uajax-form" data-target="#image-container">
                        @csrf
                        <button class="btn btn-secondary btn-sm my-2">Update image</button>
                    </form>

                    <form method="POST" action="{{ route('admin.posts.update', $post->id) }}">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="title">{{ __('Title') }}</label>
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ?: $post->title }}" required autofocus>

                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="content">{{ __('Text') }}</label>
                            <textarea id="content" class="form-control @error('body') is-invalid @enderror" name="body" required>{{ old('body') ?: $post->body }}</textarea>

                            @error('body')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

@endsection
