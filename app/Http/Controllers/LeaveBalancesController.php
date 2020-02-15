<?php

namespace App\Http\Controllers;

use App\BalanceUpdateReport;
use App\Exports\EmployeeLeaveBalanceExport;
use App\Imports\UpdatedBalance;
use App\Location;
use App\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class LeaveBalancesController extends Controller
{
    public function index(){
        $locations = Location::all();
        $roles = Role::all();
        $reports = BalanceUpdateReport::where('report_category',4)->OrderBy('created_at','DESC')->paginate(8);

        return view('leave.reports.employee_balances',compact(['locations','roles','reports']));
    }

    public function upload_balances(Request $request){
        $this->validate($request,[
            'leaves_file_upload'=>'required|mimes:xlsx,xls,csv,txt',
        ]);

        $file = $request->file('leaves_file_upload');
        if($request->hasFile('leaves_file_upload')){
            Excel::import(new UpdatedBalance(),$file);
        }
        $message = "Success";
        return redirect()->back()->with('success',$message);
    }

    public function generate(Request $request){

        //dd($request);
        $this->validate($request,[
            'location_name' => 'required',
            'role_name' => 'required',
            'start_date' => 'required|',
            'end_date' => 'required|after_or_equal:start_date'
        ]);

        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $location_name = $request->location_name;
        $role = $request->role_name;
        $name = auth()->user()->name;
        $date = Carbon::now()->format('Y-m-d H i s');



        $report = new BalanceUpdateReport();
        $report->user_id = auth()->user()->id;
        $report->report_id = $role;
        $report->report_name = ''.$name.'_'.$date.'.'.'xlsx';
        $report->report_category=4;
        $report->save();

        //dd($report);

        $filepath = 'local/'.$name.'_'.$date.'.'.'xlsx';

        Excel::store(new EmployeeLeaveBalanceExport($location_name, $role, $end_date ,$start_date),$filepath , 'local');

        alert('Agri-Leave',"Report Generated Successfully",'success');

        return redirect()->back();

    }

    public function download(BalanceUpdateReport $report){

        $flag = $report->download_flag;
        $report->update(['download_flag'=>$flag+1]);

        $file_path = storage_path()."\\app\\local\\".$report->report_name;
        if(file_exists($file_path)){
            return response()->download($file_path);
        }
        alert('Agri-Leave',"report not found it might be moved or deleted contact administrator" , 'info');
        return redirect()->back();
    }
}
