@extends('layouts.main',['title'=>'','active'=>''])

@section('content')

    <form action="/generate_users_file" method="post">
        @csrf
        <div class="row">
            <div class="col-sm-2 col-md-2">
                <div class="form-group">
                    <label class="form-label"> <span><i class="fa fa-envira"></i></span> Department / Location</label>
                    <select class="custom-select" name="location_name" required>
                        <option value="" selected disabled hidden>Choose Type</option>
                        @foreach($locations as $location)
                            <option value="{{$location->id}}">{{$location->location_name}}</option>
                        @endforeach
                        <option value="100">all</option>
                    </select>

                    @error('location_name')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-2 col-md-2">
                <div class="form-group">
                    <label class="form-label"> <span><i class="fa fa-envira"></i></span> User Groups</label>
                    <select class="custom-select" name="role_name" required>
                        <option value="" selected disabled hidden>Choose Type</option>
                        @foreach($roles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                        <option value="100">all</option>
                    </select>

                    @error('role_name')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-2 col-md-2">
                <div class="form-group">
                    <label class="form-label"> <span><i class="fa fa-calendar"></i></span> Start Date<span class="form-required">*</span></label>
                    <input type="date" class="textbox form-control  @error('start_date') is-invalid @enderror" id="start_date" name="start_date" required/>
                    @error('start_date')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
            </div>
            <div class="col-sm-2 col-md-2">
                <div class="form-group">
                    <label class="form-label"> <span><i class="fe fe-sunrise"></i></span> End Date<span class="form-required">*</span></label>
                    <input type="date" class="textbox form-control  @error('end_date') is-invalid @enderror" id="end_date" name="end_date" required/>

                    @error('end_date')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-2 col-md-2">
                <div class="form-group">
                    <label class="form-label"> <span><i class="fa fa-calendar-o"></i></span> Run Report<span class="form-required">*</span></label>
                    <button type="submit" class="form-control btn-outline-success">Run Report</button>
                </div>
            </div>
            <div class="col-sm-2 col-md-2">
                <div class="form-group">
                    <label class="form-label"> <span><i class="fa fa-calendar-o"></i></span> Upload File<span class="form-required">*</span></label>
                    <button type="button" class="form-control btn-outline-success" data-toggle="modal" data-target="#myModal"><span><i class="fa fa-upload"></i></span> Upload</button>
                </div>
            </div>
        </div>
    </form>

    <table style="border-collapse:separate; border-spacing:0 15px;"
           class="table table-hover table-outline table-vcenter text-nowrap card-table table-borderless">

        <tbody>
        @foreach($reports as $report)
            <tr class="bg-white shadow-sm shadow-lg--hover">
                <td class="border-left border-lg border-success">
                    <div><span class="text-muted">Report Name : </span>{{$report->report_name}}</div>
                    @if($report->download_flag==0)
                        <div><span class="tag tag-danger">new</span></div>
                    @elseif($report->download_flag==1)
                        <div><span class="text-muted">Report Downloaded</span> <span class="tag tag-warning"> {{$report->download_flag}} </span> time</div>
                    @else
                        <div><span class="text-muted">Report Downloaded</span> <span class="tag tag-primary"> {{$report->download_flag}} </span> times</div>
                    @endif
                </td>
                <td>
                    <div><span class="text-muted">Requested By :</span> {{$report->user->name}}</div>

                </td>
                <td>
                    <div><span class="text-muted"></span></div>

                </td>
                <td>
                    <div><span class="text-muted">Date Requested :</span> {{$report->created_at}}</div>
                </td>

                <td>
                    <div>
                        <a class="text-dark" href="/download_users/{{$report->id}}">
                            <i class="fa fa-download"></i> Download
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="row justify-content-center">
        <div class="col-3 text-center">
            {!! $reports->appends(\Request::except('page'))->render() !!}
        </div>
    </div>

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <form action="/upload_users_balances_file" method="post" enctype="multipart/form-data">
                @csrf
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Select File For Upload</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                        <div class="modal-body">
                            <input type="file" class="form-control" name="leaves_file_upload">
                        </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default">Upload File</button>
                    </div>
                </div>
            </form>
        </div>
    </div>



@endsection