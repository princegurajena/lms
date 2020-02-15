<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed document
 */
class LeaveType extends Model
{
    protected $guarded = [];

    public function leave(){
        return $this->belongsTo(Leave::class,'leave_type_id','id');
    }

}
