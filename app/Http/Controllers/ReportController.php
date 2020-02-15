<?php

namespace App\Http\Controllers;

use App\Exports\LeaveExportDepartmental;
use App\Exports\LeaveExportOrganisational;
use App\Exports\LeavesExport;
use App\Leave;
use App\LeaveType;
use App\Location;
use App\Report;
use App\ReportName;
use App\Status;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;


class ReportController extends Controller
{

    public function getBuilder($type){

        $leaves = Leave::query();

        if ($type == 'individual')
        {
            $leaves = $leaves->where('user_id' , auth()->id());
        }

        if ($type == 'departmental')
        {
            $leaves = $leaves->whereHas('user' , function (Builder $builder){
                $builder->where('location_id' , auth()->user()->location_id);
            });
        }

        if (\request()->get('type'))
        {
            $leaves = $leaves->where('leaves.type_id' , \request()->get('type'));
        }

        if (\request()->get('start'))
        {
            $leaves = $leaves->where('leaves.created_at', '>=', \request()->get('start').' 00:00:00.000');
        }

        if (\request()->get('end'))
        {
            $leaves = $leaves->where('leaves.created_at', '<=', \request()->get('end').' 23:59:59.000');
        }

        return $leaves;
    }

    public function index($type)
    {
        $leaves = $this->getBuilder($type);

        if (\request()->has('run'))
        {
            $name =    'reports/'.auth()->user()->email . '-' . now()->format('Y-m-d-H-i-s') . ' ' . random_int( 10 , 99 )  . '.csv';
            $output = fopen($name , 'w+');

            fwrite($output , "ID , Start Date , End Date , Days , Supervisor Email , User Info , Status , Created".PHP_EOL);

            foreach ($this->getBuilder($type)->get() as $leave )
            {
                fwrite($output , "{$leave->id},{$leave->start_date},{$leave->end_date},{$leave->days},{$leave->supervisor_email},{$leave->user->name} {$leave->user->last_name} {$leave->user->email},{$leave->type->name},{$leave->status},{$leave->created_at}".PHP_EOL);
            }

            fclose($output);

            return response()->download(public_path($name));

        }

        $leaves_types = $this->getBuilder($type)->groupBy('leave_types.name')
            ->select([DB::raw('count(leave_types.name) as count') , 'leave_types.name'])
            ->join('leave_types' , 'type_id' , '=' , 'leave_types.id')
            ->get(['type_id'])->toArray();

        $locations =  $this->getBuilder($type)->groupBy('locations.location_name')
            ->select([DB::raw('count(locations.location_name) as count') , 'locations.location_name'])
            ->join('users' , 'user_id' , '=' , 'users.id')
            ->join('locations' , 'users.location_id' , '=' , 'locations.id')
            ->get(['type_id'])->toArray();

        $top_applicants =  $this->getBuilder($type)->groupBy('users.email')
            ->select([DB::raw('count(users.email) as count') , DB::raw('users.email as email')])
            ->join('users' , 'leaves.user_id' , '=' , 'users.id')
            ->get()->toArray();

        $top_supervisor =  $this->getBuilder($type)->where('completed' ,'=' , false)
            ->groupBy('supervisor_email')
            ->select([DB::raw('count(supervisor_email) as count') , DB::raw('supervisor_email')])
            ->get()->toArray();

        $completed =  $this->getBuilder($type)->groupBy('completed')
            ->select([DB::raw('count(completed) as count') , DB::raw('completed')])
            ->get()->toArray();

        $total  = $this->getBuilder($type)->count();

        $leaves = $leaves->latest()->limit(15)->get();

        $out = [
            'leaves' => $leaves,
            'completed' => $completed,
            'supervisor' => $top_supervisor,
            'applications' => $top_applicants,
            'locations' => $locations,
            'types' => $leaves_types,
            'total' => $total,
            'leave_types' => LeaveType::all(),
        ];


        return  view('reports.index' , $out);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function download_individual(Request $request){
        $this->validate($request,[
            'leave_type' => 'required',
            'start_date' => 'required|',
            'end_date' => 'required|after_or_equal:start_date'
        ]);

        $leave_types = LeaveType::all();
        $statuses = Status::all();
        $report_types = ReportName::all();
        $reports= Report::where('user_id',auth()->user()->id)->OrderBy('created_at','DESC')->get();

        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $leave_type = $request->leave_type;
        $report_type = $request->report_type;
        $name = auth()->user()->name;
        $date = Carbon::now()->format('Y-m-d H i s');

        $report = new Report();
        $report->user_id = auth()->user()->id;
        $report->report_id =$request->report_type;
        $report->report_name = ''.$name.'_'.$date.'.'.'xlsx';
        $report->report_category=1;
        $report->save();

        $filepath = 'local/'.$name.'_'.$date.'.'.'xlsx';

        Excel::store(new LeavesExport($start_date,$end_date,$leave_type,$report_type),$filepath , 'local');
        return redirect('/download_individual_index');
    }
    public function download_individual_index(){

        $leave_types = LeaveType::all();
        $statuses = Status::all();
        $report_types = ReportName::all();
        $reports= Report::where('user_id',auth()->user()->id)->where('report_category',1)->OrderBy('created_at','DESC')->paginate(8);
        return view('leave.reports.index',compact(['leave_types','reports','report_types']));

    }

    public function download_departmental_index(){

        $leave_types = LeaveType::all();
        $statuses = Status::all();
        $report_types = ReportName::all();
        $applicants = User::where('location_id',auth()->user()->location_id)->get();
        $reports= Report::where('user_id',auth()->user()->id)->where('report_category',2)->OrderBy('created_at','DESC')->paginate(8);
        return view('leave.reports.departmental',compact(['leave_types','reports','report_types','applicants']));

    }





    public function download_departmental(Request $request){
        $this->validate($request,[
            'leave_type' => 'required',
            'start_date' => 'required|',
            'end_date' => 'required|after_or_equal:start_date'
        ]);

        $leave_types = LeaveType::all();
        $statuses = Status::all();
        $report_types = ReportName::all();
        $reports= Report::where('user_id',auth()->user()->id)->OrderBy('created_at','DESC')->get();

        $applicant = $request->applicant;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $leave_type = $request->leave_type;
        $report_type = $request->report_type;
        $name = auth()->user()->name;
        $date = Carbon::now()->format('Y-m-d H i s');

        $report = new Report();
        $report->user_id = auth()->user()->id;
        $report->report_id =$request->report_type;
        $report->report_name = ''.$name.'_'.$date.'.'.'xlsx';
        $report->report_category=2;
        $report->save();

        $filepath = 'local/'.$name.'_'.$date.'.'.'xlsx';

        Excel::store(new LeaveExportDepartmental($start_date,$end_date,$leave_type,$report_type,$applicant),$filepath , 'local');
        return redirect('/download_departmental_index');
    }

    public function download_organisational_index(){

        $leave_types = LeaveType::all();
        $statuses = Status::all();
        $report_types = ReportName::all();
        $locations = Location::all();
        $reports= Report::where('user_id',auth()->user()->id)->where('report_category',3)->OrderBy('created_at','DESC')->paginate(8);
        return view('leave.reports.organisation',compact(['leave_types','reports','report_types','locations']));

    }

    public function download_organisational(Request $request){
        $this->validate($request,[
            'leave_type' => 'required',
            'start_date' => 'required|',
            'end_date' => 'required|after_or_equal:start_date'
        ]);



        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $leave_type = $request->leave_type;
        $report_type = $request->report_type;
        $location = $request->location;
        $name = auth()->user()->name;
        $date = Carbon::now()->format('Y-m-d H i s');

        $report = new Report();
        $report->user_id = auth()->user()->id;
        $report->report_id =$request->report_type;
        $report->report_name = ''.$name.'_'.$date.'.'.'xlsx';
        $report->report_category=3;
        $report->save();

        $filepath = 'local/'.$name.'_'.$date.'.'.'xlsx';

        Excel::store(new LeaveExportOrganisational($start_date,$end_date,$leave_type,$report_type,$location),$filepath , 'local');

        return redirect('/download_organisational_index');
    }
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */

    public function download(Report $report){

        $flag = $report->download_flag;
        $report->update(['download_flag'=>$flag+1]);

        $file_path = storage_path()."\\app\\local\\".$report->report_name;
        if(file_exists($file_path)){
            return response()->download($file_path);
        }
        alert('Agri-Leave',"report not found it might be moved or deleted contact administrator" , 'info');
        return redirect()->back();
    }

    public function employee_balance_reco(){

        $leave_types = LeaveType::all();
        $statuses = Status::all();
        $report_types = ReportName::all();
        $reports= Report::where('user_id',auth()->user()->id)->where('report_category',1)->OrderBy('created_at','DESC')->paginate(8);
        return view('leave.reports.employee_balances',compact(['leave_types','reports','report_types']));

    }

    public function edit(Report $report)
    {
        //vvstorage/app/local/Ronald N Kanyepi_2019-09-09 21 39 42.xlsx
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }
}
