<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use function alert;
use App\Department;
use App\Events\UserCreated;
use App\Leave;
use App\LeaveType;
use App\Location;
use App\User;
use function auth;
use Carbon\Carbon;
use function dd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use function view;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $colums = [
            'emp_num',
            'name',
            'last_name',
            'job_title',
            'address',
            'gender',
            'mobile_number',
            'office_number',
            'supervisor_email',
        ];

        $users = User::query();

        if ($request->get('search')){
            $users = $users->where(function (Builder $builder) use ($colums , $request){
                foreach ($colums as $colum)
                {
                    $builder->orWhere($colum , 'like' , "%{$request->get('search')}%");
                }
            });
        }

        $users = $users->paginate(20);

        return view('leave.users.index',compact(['users']));
    }

    public function view(User $user){
        return view('leave.users.edit' , compact('user'));
    }


    public function update(Request $request , User $user){

        $user->update([
            'study_leave' => $request->get('study_leave'),
            'sick_leave' => $request->get('sick_leave'),
            'sick_leave_half_pay' => $request->get('sick_leave_half_pay'),
            'sick_leave_full_pay' => $request->get('sick_leave_full_pay'),
            'maternity_leave' => $request->get('maternity_leave'),
            'annual_leave' => $request->get('annual_leave'),
            'total_leave_balance' => collect($request->except('_token'))->sum(),
        ]);

        return back()->with('message' , 'User was updated successfully');
    }

    public function profile(Request $request)
    {
        $this->validate($request,[
            'emp_num'=> ['required'],
            'job_title'=> ['required'],
            'address'=> ['required'],
            'gender'=> ['required'],
            'mobile_number'=> ['required'],
            'office_number'=> ['required'],
            'supervisor_email'=> ['required' ,'exists:users,email'],
            'location'=> ['required'],
        ]);

        /** @var User $user */
        $user = auth()->user();

        $user->update([
            'emp_num' => $request->get('emp_num'),
            'job_title' => $request->get('job_title'),
            'address' => $request->get('address'),
            'gender' => $request->get('gender'),
            'mobile_number' => $request->get('mobile_number'),
            'office_number' => $request->get('office_number'),
            'supervisor_email' => $request->get('supervisor_email'),
            'location_id' => $request->get('location'),
            'profile_completed' => true
        ]);


        return back()->with('message' , 'Your Profile was updated successfully');
    }


}
