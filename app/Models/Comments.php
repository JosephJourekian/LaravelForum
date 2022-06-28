<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Threads;

class Comments extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class);
    }  

    public function getUserInfo($id){
        return (User::find($id));

    }

    public function threads()
    {
        return $this->belongsToMany(Threads::class);
    }

    public function getThreadCount($id){
        $count = 0;
        $count = Threads::where('user_id', $id)->count();
        return ($count);
    }
}
