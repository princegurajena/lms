<?php

namespace App\Http\Controllers;


use App\Charts\Echart;
use App\Charts\Highchart;
use App\Charts\MyOtherChart;
use App\Charts\UserChart;
use App\Events\AppliedSuccessfully;
use App\Events\AwaitingAuthourization;
use App\Events\LeaveAuthorized;
use App\Events\LeaveRecommended;
use App\Exports\LeavesExport;
use App\Jobs\LeaveBalancesUpdateJob;
use App\Leave;
use App\LeaveTimeline;
use App\LeaveType;
use App\Location;
use App\Status;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use function auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;



class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function create()
    {
        $leave_types = LeaveType::all();
        $user = auth()->user();

        return view('leave.apply',[
            'user' => $user,
            'leave_types' => $leave_types,
        ]);
    }

    public function view(Leave $leave)
    {
        return view('leave.view' ,compact('leave'));
    }

    public function requests(){

        $leaves = Leave::query()
            ->where(function (Builder $builder){
                $builder->orWhere('user_id','=',auth()->user()->id);
                $builder->orWhere('supervisor_email','=',auth()->user()->email);
                $builder->orWhereHas('timeline',function (Builder $b){
                    $b->where('email' , auth()->user()->email );
                });
            })
            ->latest()->paginate(5);

        return view('leave.list' , compact('leaves'));

    }

    public function all(){

        $leaves = Leave::query()->latest()
            ->paginate(5);

        return view('leave.list' , compact('leaves'));
    }


    public function store(Request $request)
    {
        /** @var User $user */
        $user = auth()->user();

        /** @var LeaveType $leave_type */
        $leave_type = LeaveType::query()->find($request->get('leave_type'));
        // check pending requests

        if (Leave::query()->where('user_id' , $user->id)->where('completed', false)->exists())
        {
            return back()->with('message' , 'You have a pending application , Cannot apply');
        }

//        if (auth()->user()->$leave_type < $this->carbon($request->get('start_date'))->diffInDays($this->carbon($request->get('end_date'))))
//        {
//            return back()->with('message' , 'You dont have enough days , Cannot apply');
//        }

        $this->validate($request, [
            'leave_type' => 'required|exists:leave_types,id',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);

        $path = null;
        $name = null;

        if ($leave_type->document)
        {
            $this->validate($request, [
                'document_name' => 'required',
            ]);
            $name = $request->file('document_name')->getClientOriginalName();
            $path = $request->file('document_name')->store('documents');

        }

        $leave = Leave::query()->create([
            'user_id' => $user->id,
            'supervisor_email' => $user->supervisor_email,
            'type_id' => $request->get('leave_type'),
            'start_date' => $this->carbon($request->get('start_date')),
            'end_date' => $this->carbon($request->get('end_date')),
            'document_path' => $path,
            'document_name' => $name,
            'status' => 'Pending Recommendation',
            'completed' =>  false
        ]);

        LeaveTimeline::query()->create([
            'email' => auth()->user()->email,
            'leave_id' => $leave->id,
            'event' => 'Created',
        ]);

        return back()->with('message' , 'Application was successful');
    }

    public function carbon($date)
    {
        if ($date === '' || empty($date)){
            return null;
        }
        $date = explode("-" , $date);
        return count($date) === 3 ? Carbon::createMidnightDate( $date[0] , $date[1] , $date[2] ) : now();
    }


    public function download(Leave $leave)
    {
        return response()->download((storage_path('/app/'.$leave->document_path)) , $leave->document_name );
    }


    public function close(Leave $leave){

        LeaveTimeline::query()->create([
            'email' => auth()->user()->email,
            'leave_id' => $leave->id,
            'event' => 'Closed',
        ]);

        $leave->update([
            'completed' => true,
            'status' => 'Closed',
        ]);

        return back()->with('message' , 'Application was successfully Closed');

    }

    public function authoriz(Leave $leave){

        LeaveTimeline::query()->create([
            'email' => auth()->user()->email,
            'leave_id' => $leave->id,
            'event' => 'Authorized',
        ]);

        $type = $leave->type;

        $leave->user->update([
            $type->map =>  $leave->user->$type->map - $leave->days
        ]);

        $leave->update([
            'status' => 'Authorized',
            'completed' => true,
        ]);

        return back()->with('message' , 'Application was successfully Authorized');

    }

    public function recommend(Leave $leave){

        LeaveTimeline::query()->create([
            'email' => auth()->user()->email,
            'leave_id' => $leave->id,
            'event' => 'Recommend',
        ]);

        $leave->update([
            'status' => 'Recommended waiting Authorisation',
            'supervisor_email' => auth()->user()->supervisor_email,
        ]);

        return back()->with('message' , 'Application was successfully Recommended');

    }

}
