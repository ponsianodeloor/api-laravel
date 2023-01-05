<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Api;

class Tag extends Model
{
    use HasFactory, Api;

    //relacion muchos a muchos
    public function posts(){
        return $this->belongsToMany(Post::class);
    }
}
