<?php

namespace App\Http\Controllers;

use App\Leave;
use App\LeaveType;
use App\User;
use function compact;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $leaves = Leave::query()
            ->where('user_id','=',auth()->user()->id)
            ->paginate(5);

        $user = auth()->user();
        $leave_types = LeaveType::all();

        return view('leave.index',compact(['user','leaves','leave_types']));
    }

    public function profile()
    {
        $user = auth()->user();
        return view('leave.profile',compact('user'));
    }
}
