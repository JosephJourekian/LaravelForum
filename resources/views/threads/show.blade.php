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
        <div class="col-md-5" style="position: relative; left: 15px;width: 210px;">
            <div class="card" style="height: 200px;">
                <div class="card-body">
                <img src="{{ asset('storage/'.$user->avatar) }}" style="border-radius: 50%; width: 50px; position: relative; left: 50px;">
                <p style="color: white; text-align:center;line-height:2;">{{ $user->username }}</p>
                <p style="color: white; text-align:center;line-height:0;">Joined on {{ $user->created_at->format('m/d/y') }}</p>
                <p style="color: white; text-align:center;line-height:1;">Total Account Likes: 20</p>
                <p style="color: white; text-align:center;line-height:0;">Number of Threads: 20</p>

                </div>
            </div>
        </div>
        <div class="col-md-8">
            
            <div class="card">
                <div class="card-header" style="color: white; font-size:20px;">{{ $thread->name }}</div>

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
                            <label for="name" class="col-md-4 col-form-label" style="font-size: 12px;">Created on {{ $thread->created_at->format('m/d/y') }}</label>
                        </div>

                        <div class="row mb-3">
                            <p class="col-md-4 col-form-label " style="width: auto; height: auto; text-align:left; white-space:pre-wrap;">{{ $thread->description }}</p>
                        </div>

                        <div style="display: flex;">
                            <div class="row">
                                <img src="{{asset("storage/". $thread->threadPic) }}" style="margin-left:-10px;">   
                            </div>

                            @if ($pics != null)
                                <div class="row">
                                    <img src="{{asset("storage/". $pics->image) }}">        
                                </div>   
                            @endif
                            
                        </div>

                        @if ($links != null)
                            <div class="row mb-3">
                                <a href="{{ $links->link }}" style="color:white; white-space: nowrap;"class="col-md-4 col-form-label text-md-end">{{ $links->link }}</a>

                            </div>
                        @endif
                            
                        
                        <div class="row mb-0">
                            <div class="col-md-6" style="display: inline-flex;">
                                <form method="POST" action="#">
                                @csrf
                                    <p>0</p>
                                    <img src="{{asset("storage/pics/thumbs up2.png") }}" width="30" height="30" style="margin-left:10px; margin-top:-10px;">
                                </form>
                                <form method="POST" action="#" style="display: inline-flex;">
                                @csrf
                                    <p style="margin-left:10px;">0</p>
                                    <img src="{{asset("storage/pics/thumbs down.png") }}" style="margin-left:10px; margin-top:-10px;" width="30" height="30">
                                </form>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
