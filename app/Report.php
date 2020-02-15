<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $guarded = [];
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
    public function reportname(){
        return $this->hasOne(ReportName::class,'id','report_id');
    }
}
