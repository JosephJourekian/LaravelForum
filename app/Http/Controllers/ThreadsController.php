<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Threads;
use App\Models\ThreadImages;
use App\Models\ThreadLinks;
use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
use DB;

class ThreadsController extends Controller
{
    public function index(){

        return view('threads.index', [
            'threads' => Threads::all()->sortByDesc("created_at"),
            'categories' => Category::all()
        ]);
    }

    public function create(){

        $size = Category::all()->count();
        
        return view('threads.create', [
            'category' => Category::all(),
            'size' => $size
        ]);
    }

    public function store(){

        $array = explode(', ',request('links'));
        $attributes = ([
            'name' => request('name'),
            'author' => auth()->user()->username,
            'user_id' => auth()->user()->id,
            'description' => request('description'),
            'threadPic' => request('ThreadPic')->store('pics', 'public'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        
        
        DB::table('threads')->insert($attributes);

        //inserting the extra images for a thread in another table
        if(request('image') != null){
            foreach (request()->file('image') as $image){
                $thread = Threads::where('name', request('name'))->first();
                $val = [
                    'thread_id' => $thread->id,
                    'image' => $image->store('pics','public'),
                ];
                DB::table('thread_images')->insert($val);
                
            }
        }
        //insert the links to another table
        foreach ($array as $item){
            $thread = Threads::where('name', request('name'))->first();
            $val = [
                'thread_id' => $thread->id,
                'link' => $item,
            ];
            DB::table('thread_links')->insert($val);
        }

        //insert the categories to another table
        foreach (request('category') as $item){
            //Note for pivot tables: Make sure both names are the same as the models IE: Category & Threads == category_threads
            $thread = Threads::where('name', request('name'))->first();
            $thread->category()->attach($item);
            /*$val = [
                'thread_id' => $thread->id,
                'link' => $item,
            ];
            DB::table('thread_links')->insert($val);*/
        }

        return view('threads.show', [
            'thread' => $thread,
            'links' => ThreadLinks::all(),
            'images' => ThreadImages::all()
        ]);
        
    }

    public function edit(){

    }

    public function update(){

    }

    public function delete(){

    }

    public function show($name){

        $thread = Threads::where('name', $name)->first();
        $user = User::find($thread->user_id);
        //$pic = ThreadImages::where('thread_id', $thread->id)->first();
        $links = ThreadLinks::where('thread_id', $thread->id)->first();

        return view('threads.show', [
            'thread' => $thread,
            'user' => $user,
            'pics' => ThreadImages::where('thread_id', $thread->id)->first(),
            'links' => $links
        ]);

    }
}
