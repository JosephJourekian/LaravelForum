<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ThreadLinks;
use App\Models\ThreadImages;
use App\Models\Category;


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


}
