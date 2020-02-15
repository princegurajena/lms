<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $guarded=[];

    public function user(){
        return $this->belongsTo(User::class,'location_id','id');
    }

    public function category(){
        return $this->hasOne(Category::class,'id','category_id');
    }

    public function leave(){
        return $this->belongsTo(Leave::class,'location_id','id');
    }


}
