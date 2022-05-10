<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Threads;

class ThreadImages extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function threads(){ //Always have the name::class be the same name as the function name{

        return $this->belongsToMany(Threads::class);
    } 
}
