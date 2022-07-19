@extends('layouts.app')

@section('content')

<style>
    body{
        background-color: rgba(26,32,44);
    }
    .card{
        background-color: rgba(45,55,72);
    }
    .category{
        width: 398px;
        height: 35px;
        border-radius: 5px;
    }
    
</style>

<head>
<title>Edit Comment</title>
</head>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card">
                <div class="card-header" style="color: white;">{{ __('Edit Comment') }}</div>

                <div class="card-body">
                    @if(session()->has('message'))
                        <div  style="color: white;">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('comments.update', $comment->id) }}" style="color: white;" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')


                        <div class="row mb-3">
                            <label for="image" class="col-md-4 col-form-label text-md-end">Comment Picture</label>

                            <div class="col-md-6">
                                <div class="flex">
                                    <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" >
                                    <p style="position: absolute; left: 130px;" >Current Comment Picture</p>
                                    <img src="{{asset('storage/'. $comment->image )}}" width="60" alt="No Image">
                                </div>

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="link" class="col-md-4 col-form-label text-md-end">{{ __('Comment Link') }}</label>

                            <div class="col-md-6">
                                <input id="link" type="text" class="form-control @error('link') is-invalid @enderror" name="link" value="{{ $comment->link }}" autocomplete="link" autofocus>

                                @error('link')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="comment" class="col-md-4 col-form-label text-md-end">{{ __('Comment') }}</label>

                            <div class="col-md-6">
                                <textarea id="comment" type="text" class="form-control @error('comment') is-invalid @enderror" name="comment" value="{{ $comment->comment }}" required autocomplete="comment" style="height: 100px;">{{ $comment->comment }}</textarea>

                                @error('comment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update Comment') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
