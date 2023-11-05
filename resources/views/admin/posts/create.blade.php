@extends('admin.app')
@section('content')

            <div class="card" style="max-width: 600px">
                <div class="card-header">{{ __('Create Post') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.posts.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="title">{{ __('Title') }}</label>
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autofocus>

                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="content">{{ __('Text') }}</label>
                            <textarea id="content" class="form-control @error('body') is-invalid @enderror" name="body" required>{{ old('body') }}</textarea>

                            @error('body')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Create') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

@endsection
