<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Comments;
use App\Models\Threads;
use DB;

class CommentsController extends Controller
{
    public function store(){

        $attributes = ([
            'thread_id' => request('thread_id'),
            'user_id' => auth()->user()->id,
            'comment' => request('description'),
            'link' => request('link'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        if(request('CommentPic'))
        {
            $attributes['image'] = request('CommentPic')->store('pics', 'public');
        }
   
        DB::table('comments')->insert($attributes);

        $comments = Comments::all()->where('thread_id', request('thread_id'));

        $thread = Threads::find(request('thread_id'))->first();

        return app('App\Http\Controllers\ThreadsController')->show($thread->name);
    
    }

    public function edit(){

    }

    public function update(){

    }

    public function delete(){

    }
}
