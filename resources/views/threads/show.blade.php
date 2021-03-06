@extends('layouts.app')

@section('content')

<style>
    
    .btn.btn-danger {
        background-color: red !important;
        background-image: none;
    }
    body{
        background-color: rgba(26,32,44);
    }
    .card{
        background-color: rgba(45,55,72);
        border:none;

    }
    
</style>

<head>
    <title>{{ $thread->name }}</title>
</head>

<div class="container">
    <div class="row justify-content-center"><!--Thread is here -->
        <div class="col-md-5" style="position: relative; left: 15px;width: 210px;">
            <div class="card" style="height: 200px;">
                <div class="card-body">
                <img src="{{ asset('storage/'.$user->avatar) }}" style="border-radius: 50%; width: 50px; position: relative; left: 50px;">
                <p style="color: white; text-align:center;line-height:2;">{{ $user->username }}</p>
                <p style="color: white; text-align:center;line-height:0;">Joined on {{ $user->created_at->format('m/d/y') }}</p>
                <p style="color: white; text-align:center;line-height:1;">Total Account Likes: 20</p>
                <p style="color: white; text-align:center;line-height:0;">Number of Threads: {{ $user->getThreadCount($user->id) }}</p>

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

                        <div>
                            <div class="row mb-3">
                                <img src="{{asset("storage/". $thread->threadPic) }}" style="width:300px; height:200px;">   
                            </div>

                            @if ($pics != null)
                                @foreach ($pics as $pic)
                                    <div class="row">
                                      <div class="col-sm">
                                        <div class="card mb-3">
                                            <img src="{{asset("storage/". $pic->image) }}" style="width:300px; height:200px;">        
                                        </div>
                                      </div>
                                    </div>   
                                @endforeach
                            @endif
                            
                        </div>

                        @if ($links != null)
                            @foreach ($links as $link)
                            <div style="display: inline; margin-right:20px;">
                                <a href="{{ $link->link }}" style="color:white; white-space: nowrap;"class="col-md-4 col-form-label text-md-end">{{ $link->link }}</a>
                            </div>
                            @endforeach
                        @endif
                        
                        <div class="row mb-0">
                            <div class="col-md-6" style="display: inline-flex; margin-top:25px;">
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

                                @if ($thread->user_id == auth()->user()->id)
                                    <div style="position: relative; left:480px; display:flex;">
                                        <form method="POST" action="{{ route('threads.delete') }}"> 
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $thread->id }}"> 
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger"> Delete Thread</button>
                                        </form>
                                        <button type="submit" class="btn btn-primary" style="margin-left: 20px;">
                                            <a href="{{ route('threads.edit',$thread->name) }}" style="text-decoration: none; color: white;" >Edit Thread</a>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
    <!--Comments go here-->
    @if ($comments != '[]')
    @foreach ($comments as $comment)
    <div class="row justify-content-center mt-5"><!--Thread is here -->
        <div class="col-md-5" style="position: relative; left: 15px;width: 210px;">
            <div class="card" style="height: 200px;">
                <p hidden> {{ $userInfo = $comment->getUserInfo($comment->user_id) }}<p>
                <div class="card-body">
                <img src="{{ asset('storage/'.$userInfo->avatar) }}" style="border-radius: 50%; width: 50px; position: relative; left: 50px;">
                <p style="color: white; text-align:center;line-height:2;">{{ $userInfo->username }}</p>
                <p style="color: white; text-align:center;line-height:0;">Joined on {{ $userInfo->created_at->format('m/d/y') }}</p>
                <p style="color: white; text-align:center;line-height:1;">Total Account Likes: 20</p>
                <p style="color: white; text-align:center;line-height:0;">Number of Threads: {{ $comment->getThreadCount($comment->user_id) }}</p>

                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
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
                            <label for="name" class="col-md-4 col-form-label" style="font-size: 12px;">Posted on {{ $comment->created_at->format('m/d/y') }}</label>
                        </div>

                        <div class="row mb-3">
                            <p class="col-md-4 col-form-label " style="width: auto; height: auto; text-align:left; white-space:pre-wrap;">{{ $comment->comment }}</p>
                        </div>

                        @if ( $comment->image != null )
                        <div style="display: flex;">
                            <div class="row">
                                <img src="{{asset("storage/". $comment->image) }}" style="margin-left:-10px;">   
                            </div>
                        </div>  
                        @endif

                        <div class="row mb-3">
                            <a href="{{ $comment->link }}" style="color:white; white-space: nowrap;"class="col-md-4 col-form-label text-md">{{ $comment->link }}</a>
                        </div>
                        
                            
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

                                @if ($comment->user_id == auth()->user()->id || auth()->user()->type == "admin")
                                    <div style="position: relative; left:450px; display:flex;">
                                        <form method="POST" action="{{ route('comments.delete') }}"> 
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $comment->id }}"> 
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger"> Delete Comment</button>
                                        </form>
                                        <button type="submit" class="btn btn-primary" style="margin-left: 20px;">
                                            <a href="{{ route('comments',$comment->id) }}" style="text-decoration: none; color: white;" >Edit Comment</a>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endif



    <!--form to post a comment-->
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card" style="position: relative; left: 105px;">
                <div class="card-header" style="color: white; font-size:20px;">Post A Comment</div>

                <div class="card-body">
                    @if(session()->has('message'))
                        <div  style="color: white;">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('comments.store') }}" style="color: white;" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Comment') }}</label>

                            <input name="thread_id" id="thread_id" value="{{ $thread->id }}" hidden>
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
                            <label for="CommentPic" class="col-md-4 col-form-label text-md-end">Picture</label>

                            <div class="col-md-6">
                                <input id="CommentPic" type="file" class="form-control @error('CommentPic') is-invalid @enderror" name="CommentPic" value="{{ old('CommentPic') }}" >

                                @error('CommentPic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="link" class="col-md-4 col-form-label text-md-end">{{ __('Link') }}</label>

                            <div class="col-md-6">
                                <input id="link" type="text" class="form-control @error('link') is-invalid @enderror" name="link" value="{{ old('link') }}">

                                @error('link')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Post Comment') }}
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
