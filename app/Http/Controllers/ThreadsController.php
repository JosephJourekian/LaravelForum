<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Threads;
use App\Models\ThreadImages;
use App\Models\ThreadLinks;
use App\Models\Category;
use App\Models\User;
use App\Models\Comments;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use DB;

class ThreadsController extends Controller
{
    public function index(){

        $title = null;
        $trend = '0';
        if(request('trending') == 1){//If the user clicks on trending
            $trend = 'Most Trending Threads';
            return view('threads.index', [
                'threads' => Threads::all()->sortByDesc("commentCount"),
                'trend' => $trend,
                'title' => $title,
                'categories' => Category::all()
            ]);
        }

        if (request('category')){
            $threads = Category::where('name', request('category'))->firstOrFail()->threads;
            $title = request('category');

            return view('threads.index', [
                'threads' => $threads,
                'trend' => $trend,
                'title' => $title,
                'categories' => Category::all()
            ]);
        }

        return view('threads.index', [
            'threads' => Threads::all()->sortByDesc("created_at"),
            'trend' => $trend,
            'title' => $title,
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

        $thread = Threads::where('name', request('name'))->first();

        $user = User::find($thread->user_id);

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

        $pics = ThreadImages::where('thread_id', $thread->id)->get();
        $links = ThreadLinks::where('thread_id', $thread->id)->get();
        $comments = Comments::where('thread_id', $thread->id)->get();


        return view('threads.show', [
            'thread' => $thread,
            'user' => $user,
            'links' => $links,
            'pics' => $pics,
            'comments' => $comments
        ]);
        
    }

    public function edit(Threads $thread){

        $size = Category::all()->count();
        $links = ThreadLinks::where('thread_id', $thread->id)->get();
        $pics = ThreadImages::where('thread_id', $thread->id)->get();
        $comments = Comments::where('thread_id', $thread->id)->get();


        return view('threads.edit', [ 
            'thread' => $thread,
            'category' => Category::all(),
            'size' => $size,
            'links' => $links,
            'pics' => $pics,
            'comments' => $comments
        ]);
    }

    public function update(Threads $thread){

        $attributes = ([
            'name' => request('name'),
            'author' => auth()->user()->username,
            'user_id' => auth()->user()->id,
            'description' => request('description'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        
        $thread->update($attributes);

        foreach (request('category') as $item){
            $thread->category()->syncWithoutDetaching([$item]); //Attaches only those not in the pivot table
        }
        //Calls a function from another controller.
        return app('App\Http\Controllers\ThreadsController')->show($thread->name);
    }

    public function delete(){
        $id = request('id');
        Threads::where('id', $id)->delete();
        
        return view('threads.index', [
            'threads' => Threads::all()->sortByDesc("created_at"),
            'categories' => Category::all()
        ]);
    }

    public function show($name){

        $thread = Threads::where('name', $name)->first();
        $user = User::find($thread->user_id);
        $links = ThreadLinks::where('thread_id', $thread->id)->get();
        $comments = Comments::where('thread_id', $thread->id)->get();
        $pics = ThreadImages::where('thread_id', $thread->id)->get();

        return view('threads.show', [
            'thread' => $thread,
            'user' => $user,
            'pics' => $pics,
            'links' => $links,
            'comments' => $comments
        ]);

    }
}
