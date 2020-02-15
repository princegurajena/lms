<?php

namespace App\Http\Controllers;

use App\Events\AppliedSuccessfully;
use App\Leave;
use App\LeaveType;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LeaveRetrospectController extends Controller
{
    public function index()
    {
        $leave_types=LeaveType::all();

        $supervisors = User::where('location_id',auth()->user()->location_id)->role('Supervisor')->get();
        return view('leave.leaves_in_retrospect',compact(['leave_types','chart','supervisors']));
    }
    public function store(Request $request){
        $current_date = Carbon::now();
        $this->validate($request,[
            'leave_type' => 'required',
            'start_date' => 'required|before:'.$current_date,
            'end_date' => 'required|after_or_equal:start_date'
        ]);

        if(auth()->user()->getRoleNames()[0]=='General'){
            $head_id=User::where('location_id',auth()->user()->location_id)->role('Head Of Department')->value('id');
            $status_id=1;
            $supervisor_id=User::where('location_id',auth()->user()->location_id)->role('Supervisor')->value('id');
        }
        elseif(auth()->user()->getRoleNames()[0]=='Supervisor'){
            $head_id=User::where('location_id',auth()->user()->location_id)->role('Head Of Department')->value('id');
            $status_id=2;
            $supervisor_id=auth()->user()->id;
        }
        elseif(auth()->user()->getRoleNames()[0]=='Head Of Department'){
            $head_id=User::select('id')->role('Executive Human Resources')->value('id');
            $status_id=1;
            $supervisor_id=User::where('location_id',auth()->user()->location_id)->role('Supervisor')->value('id');
        }

        elseif(auth()->user()->getRoleNames()[0]=='System Administrator'){
            abort('503','System Administrators are not allowed to apply for leaves');
        }




        $leave = new Leave();
        $leave->user_id=auth()->user()->id;
        $leave->status_id=$status_id;
        $leave->leave_type_id=$request->leave_type;
        $leave->start_date=$request->start_date;
        $leave->end_date=$request->end_date;
        $leave->location_id=auth()->user()->location_id;
        $leave->head_id=$head_id;
        $leave->supervisor_id=$supervisor_id;
        $leave->save();


        //event(new AppliedSuccessfully($leave));

        $message = 'Your leave application was successfull';

        //alert()->success('Agribank Leave Management System','your have successfully submitted your leave application');
        //alert('Agri-Leave','you have successfully submitted your leave application', 'warning')->addImage('images/welcome.jpg')->width('350px')->persistent(false,false);
        //alert()->image('Leave Application','you have submitted your leave application','images/logo.png','100','100');

        return redirect()->back()->with('success',$message);


    }
}
