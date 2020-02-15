<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * @property mixed profile_completed
 * @property mixed id
 * @property mixed supervisor_email
 * @property mixed email
 */
class User extends Authenticatable implements MustVerifyEmail,Auditable
{
    use Notifiable;
    use HasRoles;
    use \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //    protected $fillable = [
//        'name', 'email', 'password','allowed','email_verified_at'
//    ];
    protected $guarded = [];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function leave(){
        return $this->hasMany(Leave::class,'user_id','id');
    }

    public function leave_supervisor(){
        return $this->hasMany(Leave::class,'supervisor_id','id');
    }


    public function location (){
        return $this->hasOne(Location::class,'id','location_id');
    }

    public function department(){
        return $this->hasOne(Department::class,'id','department_id');
    }

    public function scopeSearch($query,$search)
    {


        return $query->where('id', 'like', '%' . $search . '%')
            ->orWhere('surname', 'like', '%' . $search . '%')
            ->orWhere('firstname', 'like', '%' . $search . '%')
            ->orWhere('name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
            ->orWhere('mobile_number', 'like', '%' . $search . '%')
            ->orWhere('office_number', 'like', '%' . $search . '%')
            ->orWhere('job_title', 'like', '%' . $search . '%')
            ->orWhere('gender', 'like', '%' . $search . '%');
    }
}
