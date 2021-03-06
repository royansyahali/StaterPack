@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Learnig') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @elseif (session('danger'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('danger') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('post.update', ['post'=> $post->slug]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="name_video" class="col-md-4 col-form-label text-md-right">{{ __('Name Video') }}</label>

                            <div class="col-md-6">
                                <input id="name_video" type="text" class="form-control @error('name_video') is-invalid @enderror" name="name_video" value="{{ old('name_video') ?? $post->name_video }}" required autocomplete="name_video" autofocus>

                                @error('name_video')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="video" class="col-md-4 col-form-label text-md-right">{{ __('Link Video') }}</label>

                            <div class="col-md-6">
                                <input id="video" type="text" class="form-control @error('video') is-invalid @enderror" name="video" value="{{ old('video') ?? $post->video }}" autocomplete="video" autofocus>

                                @error('video')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>

                            <div class="col-md-6">
                                <select id="category" class="form-control  @error('category') is-invalid @enderror" name="category_id">
                                    <option disabled selected>Choose One!</option>

                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"  {{$post->category_id == $category->id  ? 'selected' : ''}}>{{ $category->category }}</option>
                                @endforeach

                                </select>
                                @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="order" class="col-md-4 col-form-label text-md-right">{{ __('Order') }}</label>

                            <div class="col-md-6">
                                <input id="order" min="1" type="number" class="form-control @error('order') is-invalid @enderror" name="order" value="{{ old('order') ?? $post->order}}" autocomplete="order" autofocus>

                                @error('order')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="start" class="col-md-4 col-form-label text-md-right">{{ __('Time Start') }}</label>

                            <div class="col-md-6">
                                <input id="start" min="0" type="number" class="form-control @error('start') is-invalid @enderror" name="start" value="{{ old('start') ?? $post->start }}" autocomplete="start" autofocus>

                                @error('start')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="end" class="col-md-4 col-form-label text-md-right">{{ __('Time End') }}</label>

                            <div class="col-md-6">
                                <input id="end" min="0" type="number" class="form-control @error('end') is-invalid @enderror" name="end" value="{{ old('end') ?? $post->end }}" autocomplete="end" autofocus>

                                @error('end')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="exampleFormControlTextarea1">{{ __('Description Video') }}</label>

                            <div class="col-md-6">
                                <textarea name="description" placeholder="Description Video" class="form-control @error('description') is-invalid @enderror" name="description"  autocomplete="description" id="exampleFormControlTextarea1" rows="3" autofocus>{{ $post->description }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="offset-md-10 col-md-2">
                            <button type="submit" class="btn btn-dark">
                                {{ __('Submit') }}
                            </button>
                        </div>
                    </form>

                    <form action="{{ route('post.delete', ['post' => $post->id]) }}"
                        method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger ml-3">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
