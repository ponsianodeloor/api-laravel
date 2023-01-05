<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Api{

    public function scopeIncluded(Builder $query){
        if (empty($this->allow_included) || empty(request('included'))){
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

    public function scopeSort(Builder $query){
        if (empty($this->allow_sort) || empty(request('sort'))){
            return;
        }

        $sort_fields = explode(',', request('sort'));
        $allow_sort = collect($this->allow_sort);

        foreach ($sort_fields as $sort_field){
            $direction = 'ASC'; //ASC or DESC

            if (substr($sort_field, 0,1) == '-'){
                $direction = 'DESC';
                $sort_field = substr($sort_field, 1);
            }

            if ($allow_sort->contains($sort_field)){
                $query->orderBy($sort_field, $direction);
            }
        }
    }

    public function scopeGetOrPaginate(Builder $query){
        if(request('perPage')){
            $per_page = intval(request('perPage'));

            if ($per_page){
                return $query->paginate($per_page);
            }
        }

        return $query->get();
    }
}
