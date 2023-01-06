<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Api;

class Post extends Model
{
    use HasFactory, Api;

    const BORRADOR = 1, PUBLICADO = 2;

    protected $fillable = [
        'name',
        'slug',
        'extract',
        'body',
        'status',
        'category_id',
        'user_id'
    ];

    //relacion uno a muchos inversa
    public function user(){
        return $this->belongsTo(User::class);
    }

    //relacion uno a muchos inversa
    public function category(){
        return $this->belongsTo(Category::class);
    }

    //relacion muchos a muchos
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    //relacion uno a muchos polimorfica
    public function images(){
        return $this->morphMany(Image::class, 'imageable');
    }

}
