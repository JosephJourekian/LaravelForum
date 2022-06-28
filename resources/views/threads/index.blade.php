@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>LaravelForum</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: rgba(26,32,44);
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .block{
                width: 1000px;
                border: 2px;
                padding: 5px;
                background-color: rgb(28, 90, 130);
                position: relative;
                right: 145px;
                border-radius: 3px;
            }
            .blockCategories{
                width: 1000px;
                border: 2px;
                background-color: rgba(45,55,72);
                position: relative;
                right: 145px;
                height: 100px;
                border-radius: 3px;
            }
            .blockTitle{
                color: white;
                position: relative;
                left: 15px;
                text-align: left;
                font-weight: bold;
                font-size: 20px;
                top: 6px;
            }
            .categoryName{
                color: white;
                position: relative;
                left: 25px;
                text-align: left;
                font-weight: bold;
                font-size: 15px;
                top: -2px;
            }
            .categoryThread{
                color: white;
                position: relative;
                left: 25px;
                text-align: left;
                font-weight: bold;
                font-size: 15px;
                top: -2px;
            }
            .threadName{
                color: white;
                font-size: 15px;
                font-weight: bold;
                text-align: left;
                text-decoration: none;
                position: relative;
                left: 100px;
                top: 35px;
                z-index: 9999999999;
                
            }
            .threadNumber{
                color: white;
                font-size: 15px;
                position: relative;
                bottom: 100px;
                left: 230px;
            }
            .threadNumValue{
                color: white;
                font-size: 15px;
                position: relative;
                bottom: 90px;
                left: 230px;
            }
            .postsNumber{
                color: white;
                font-size: 15px;
                position: relative;
                bottom: 150px;
                left: 370px;
            }
            .postsNumValue{
                color: white;
                font-size: 15px;
                position: relative;
                bottom: 140px;
                left: 370px;
            }
            .threadPic{
                height: 70px;
                width: 70px;
                border-radius: 50%;
                position: relative;
                left: -450px;
                bottom: 15px;
            }
            .threadDate{
                color: white;
                position: relative;
                top: -50px;
                right: -100px;
                font-size: 13px;
                text-align: left;
                width: fit-content;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height" style="height: 100%;">

            <div class="content">
                <div class="title m-b-md" style="color: white;" >
                    LaravelForum
                </div>

                <div class="links" style="position: relative; bottom: 30px;">
                    <h1 style="color:white;">Welcome {{ auth()->user()->username }}!</h1>
                </div>
                <div class="block">
                    <h1 class="blockTitle">Most Recent Threads</h1>
                </div>
                @foreach ($threads as $thread)
                    <div class="blockCategories">
                        <div style="width: fit-content">
                            <a href="{{ route('threads.show',$thread->name) }}" class="threadName"><p style="width: fit-content;">{{ \Illuminate\Support\Str::limit($thread->name, 30, $end="..") }}</p></a>
                        </div>
                        <img class="threadPic" src="{{asset('storage/'.$thread->threadPic) }}" alt="Thread Pic">
                        <h5 class="threadDate">Created on: {{ $thread->created_at->format('m/d/y') }}</h5>
                        <h2 class="threadNumber">Category</h2>
                        <h2 class="threadNumValue">{{ $thread->getCategory($thread->id) }}</h2>
                        <h2 class="postsNumber">Comments</h2>
                        <h2 class="postsNumValue">{{ $thread->getCommentsCount($thread->id) }}</h2>
                    </div> 
                @endforeach
            </div>
        </div>
    </body>
</html>
@endsection