<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Threads;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function threads()
    {
        return $this->belongsToMany(Threads::class);
    }
}
