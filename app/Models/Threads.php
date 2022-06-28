<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ThreadLinks;
use App\Models\ThreadImages;
use App\Models\Category;
use App\Models\Comments;


class Threads extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getRouteKeyName()
    {
        //This is used to search for the name instead of the id\
        return 'name';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    } 

    public function threadImages(){

        return $this->hasMany(threadImages::class);
    }  
    public function threadLinks(){

        return $this->hasMany(ThreadLinks::class);
    }  

    public function category(){

        return $this->belongsToMany(Category::class);
    }

    public function getCategory($id){

     
        $thread = Threads::find($id);
        
        foreach ($thread->category as $categories){
            
            return($categories->name);
        }
    }

    public function comments()
    {
        return $this->belongsToMany(Comments::class);
    }

    public function getCommentsCount($id){

        $count = 0;
        $count = Comments::where('thread_id', $id)->count();
        return($count);
    }

}