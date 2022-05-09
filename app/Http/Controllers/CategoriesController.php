<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use DB;

class CategoriesController extends Controller
{
    public function index()
    {

        return view('categories.index', [
            'categories' => Category::all()
        ]);
    }

    public function create()
    {
        $attributes = request()->validate([
            'name' => ['string', 'required', 'max:255'],
        ]);       
        DB::table('categories')->insert($attributes);

        return redirect()->back()->with('message', 'Category Added!');

    }

    public function delete()
    {
        $id = request('name');
        Category::where('id', $id)->delete();

        return redirect()->back()->with('message', 'Category Deleted!');

    }
}
