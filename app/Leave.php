<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use function is_numeric;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property Carbon start_date
 * @property Carbon end_date
 * @property mixed document_path
 * @property Collection timeline
 * @property mixed user_id
 * @property mixed supervisor_email
 * @property mixed completed
 * @property User user
 * @property mixed days
 * @property mixed type
 */
class Leave extends Model implements Auditable
{
   use SoftDeletes;
   use \OwenIt\Auditing\Auditable;
   use Notifiable;

    protected $guarded=[];
    protected $dates = [
        'start_date',
        'end_date',
    ];

    public function timeline()
    {
        return $this->hasMany(LeaveTimeline::class , 'leave_id' ,'id');
    }

    public function getDaysAttribute(){
      return $this->start_date->diffInDays($this->end_date);
    }

    public $sortable = ['id', 'user_id', 'leave_type_id', 'created_at', 'updated_at'];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function supervisor(){
        return $this->belongsTo(User::class,'supervisor_id','id');
    }

    public function head(){
        return $this->belongsTo(User::class,'head_id','id');
    }

    public function type(){
        return $this->hasOne(LeaveType::class,'id','type_id');
    }

    public function status(){
        return $this->hasOne(Status::class,'id','status_id');
    }

    public function location(){
        return $this->HasOne(Location::class,'id','location_id');
    }



    public function scopeSearch($query,$search){
        $name = User::select('id')->where('name','like','%'.$search.'%')->first();
        $leave_type = LeaveType::select('id')->where('leave_type_name','like','%'.$search.'%')->first();
        $status = Status::select('id')->where('status_name','like','%'.$search.'%')->first();
        if(is_numeric($search)){
            return $query->where('id',$search);
        }
        else{
            return $query->where('id','like','%'.$search.'%')
                ->orWhere('created_at','like','%'.$search.'%')
                ->orWhere('user_id',$name['id'])
                ->orWhere('supervisor_id',$name['id'])
                ->orWhere('leave_type_id',$leave_type['id'])
                ->orWhere('status_id',$status['id']);
        }


    }
}
