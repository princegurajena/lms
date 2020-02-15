@extends('layouts.main',['title'=>'','active'=>''])

@section('content')
    <div class="row row-cards row-deck">
        <div class="col-lg-12">
            <div class="card card-aside">
                <a href="#" class="card-aside-column" style="background-image: url('{{asset('images/welcome.jpg')}}');""></a>
                <div class="card-body d-flex flex-column">
                    <h4><a href="#">AGRI- LEAVE</a></h4>
                    <div class="text-muted">Reports for Agribank Zimbabwe</div>
                    <div class="d-flex align-items-center pt-5 mt-auto">
                        <div class="avatar avatar-md mr-3" style="background-image: url('{{asset('images/logo.png')}}');"></div>
                        <div>
                            <a href="./profile.html" class="text-default">Rose Bradley</a>
                            <small class="d-block text-muted">3 days ago</small>
                        </div>
                        <div class="ml-auto text-muted">
                            <a href="javascript:void(0)" class="icon d-none d-md-inline-block ml-3"><i class="fe fe-heart mr-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>





    <div class="row row-cards">
        <div class="col-lg-3">
            <div class="row">
                <div class="col-md-6 col-lg-12 card">
                    <form action="/download_organisational" method="POST">
                        @csrf
                            <div class="form-group">
                                <label class="form-label"> <span><i class="fa fa-envira"></i></span> Leave Type</label>
                                <select class="custom-select" name="leave_type" required>
                                    <option value="" selected disabled hidden>Choose Leave Type</option>
                                    @foreach($leave_types as $leave_type)
                                        <option value="{{$leave_type->id}}">{{$leave_type->leave_type_name}}</option>
                                    @endforeach
                                    <option value="100">all</option>
                                </select>

                                @error('leave_type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            <div class="form-group">
                                <label class="form-label"> <span><i class="fa fa-calendar"></i></span> Start Date<span class="form-required">*</span></label>
                                <input type="date" class="textbox form-control  @error('start_date') is-invalid @enderror" id="start_date" name="start_date" required/>
                                @error('start_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label class="form-label"> <span><i class="fe fe-sunrise"></i></span> End Date<span class="form-required">*</span></label>
                                <input type="date" class="textbox form-control  @error('end_date') is-invalid @enderror" id="end_date" name="end_date" required/>
                                @error('end_date')
                                <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label class="form-label"> <span><i class="fa fa-calendar-o"></i></span> State<span class="form-required">*</span></label>
                                <select class="custom-select" name="report_type" required>
                                    <option value="" selected disabled hidden>Choose State</option>
                                    @foreach($report_types as $report_type)
                                        <option value="{{$report_type->id}}">{{$report_type->name}}</option>
                                    @endforeach
                                </select>

                                @error('report_type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                                <div class="form-group">
                                    <label class="form-label"> <span><i class="fa fa-calendar-o"></i></span>Location<span class="form-required">*</span></label>
                                    <select class="custom-select" name="location" required>
                                        <option value="" selected disabled hidden>Choose Location</option>
                                        @foreach($locations as $location)
                                            <option value="{{$location->id}}">{{$location->location_name}}</option>
                                        @endforeach
                                        <option value="100">all @ agribank</option>
                                    </select>

                                    @error('report_type')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>

                            <div class="form-group ">
                                <button type="submit" class="btn btn-outline-success">Run Report</button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <table style="border-collapse:separate; border-spacing:0 15px;"
                   class="table table-hover table-outline table-vcenter text-nowrap card-table table-borderless">

                <tbody>
                @foreach($reports as $report)
                    <tr class="bg-white shadow-sm shadow-lg--hover">
                        <td class="border-left border-lg border-success">
                            <div><span class="text-muted">Report Name : </span>{{$report->reportname->name}}</div>
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
                                <a class="text-dark" href="/download/{{$report->id}}">
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

        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-3 text-center">
            {!! $reports->appends(\Request::except('page'))->render() !!}
        </div>
    </div>



@endsection