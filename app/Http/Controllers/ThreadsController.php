<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Threads;
use DB;

class ThreadsController extends Controller
{
    public function index(){

        return view('threads.index', [
            'threads' => Threads::orderBy('created_at', 'desc')
        ]);
    }

    public function create(){

        return view('threads.create');
    }

    public function store(){

        
    }

    public function edit(){

    }

    public function update(){

    }

    public function delete(){

    }
}
