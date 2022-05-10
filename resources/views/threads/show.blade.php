@extends('layouts.app')

@section('content')

<style>
    body{
        background-color: rgba(26,32,44);
    }
    .card{
        background-color: rgba(45,55,72);
    }
    
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card">
                <div class="card-header" style="color: white;">{{ $thread->name }}</div>

                <div class="card-body">
                    @if(session()->has('message'))
                        <div  style="color: white;">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('threads.store') }}" style="color: white;" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Thread Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description" style="height: 100px;"></textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="ThreadPic" class="col-md-4 col-form-label text-md-end">Thread Picture</label>

                            <div class="col-md-6">
                                <input id="ThreadPic" type="file" class="form-control @error('ThreadPic') is-invalid @enderror" name="ThreadPic" value="{{ old('ThreadPic') }}" >


                                @error('ThreadPic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="image[]" class="col-md-4 col-form-label text-md-end">Images (Ctrl + Click for multiple)</label>

                            <div class="col-md-6">
                                <input id="image[]" type="file" class="form-control @error('image[]') is-invalid @enderror" name="image[]" value="" multiple>


                                @error('image[]')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="links" class="col-md-4 col-form-label text-md-end">{{ __('Links (for multiple put a comma and space after each link)') }}</label>

                            <div class="col-md-6">
                                <input id="links" type="text" class="form-control @error('links') is-invalid @enderror" name="links" value="{{ old('links') }}">

                                @error('links')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Post Thread') }}
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
