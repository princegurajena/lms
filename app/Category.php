<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded=[];
    public function location()
    {
        return $this->belongsTo(Location::class,'category_id','id');
    }
}
