<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Api;

class Image extends Model
{
    use HasFactory, Api;

    public function imageable(){
        return $this->morphTo();
    }
}
