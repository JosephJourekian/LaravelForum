@extends('layouts.app')

@section('content')

<style>
    body{
        background-color: rgba(26,32,44);
    }
    .card{
        background-color: rgba(45,55,72);
    }
    .deleteCat{
        margin-top: 14px;
        width: 398px;
        height: 35px;
        border-radius: 5px;
    }
    .btn.btn-danger{
        background: red;
    }
    
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="color: white;">Add/Delete a Category</div>

                <div class="card-body">
                    @if(session()->has('message'))
                        <div  style="color: white;">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('categories.create') }}" style="color: white;" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Add a Category') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="string" class="form-control @error('name') is-invalid @enderror" name="name" value="">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add Category') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <form method="POST" action="{{ route('categories.delete') }}" style="color: white;" enctype="multipart/form-data">
                        @csrf
                        @method('DELETE')
                        <div class="row mb-3">
                            <label for="category" class="col-md-4 col-form-label text-md-end">{{ __('Delete a Category') }}</label>

                            <div class="col-md-6">
                                <select name="name"  class="deleteCat" required>
                                    @foreach($categories as $categorie)
                                        <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4" >
                                <button type="submit" class="btn btn-danger">
                                    {{ __('Delete Category') }}
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