<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];

    /**
     * @var string[] lista blanca para obtener los scopes separados por , en la url
     */
    protected $allow_included = ['posts', 'posts.user'];
    protected $allow_filter = ['id', 'name', 'slug'];

    //relacion uno a muchos
    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function scopeIncluded(Builder $query){
        if (empty($this->allowIncluded) || empty(request('included'))){
            return;
        }

        $relations = explode(',', request('included')); // ['posts', 'posts.user']
        $allow_included = collect($this->allow_included);

        foreach ($relations as $key => $relationship) {
            if (!$allow_included->contains($relationship)){
                unset($relations[$key]);
            }
        }

        $query->with($relations);
    }

    public function scopeFilter(Builder $query){
        if (empty($this->allow_filter) || empty(request('filter'))){
            return;
        }

        $filters = request('filter');
        $allow_filter = collect($this->allow_filter);

        foreach ($filters as $filter => $value){
            if ($allow_filter->contains($filter)){
                //$query->where($filter, $value);
                $query->where($filter, 'LIKE','%'.$value.'%');
            }
        }
    }
}
