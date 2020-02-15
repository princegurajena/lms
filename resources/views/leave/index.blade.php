@extends('layouts.main',['title'=>'','active'=>''])

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @if(session()->has('message'))
                <div class="alert alert-success rounded-0 text-center">
                    {{ session()->get('message') }}
                </div>
            @endif
        </div>
        <div class="col-lg-3">
            <div class="card card-profile">
                <div class="card-header" style="background-image: url('{{asset('images/pic2.jpeg')}}');"></div>
                <div class="card-body text-center">
                    <img class="card-profile-img" src="{{asset('images/logo_new.jpg')}}">
                    <h3 class="mb-3">{{auth()->user()->name}}</h3>
                    <small class="text-muted d-block mt-1">{{auth()->user()->job_title}}</small>
                    <p class="mb-4">
                        {{old('name',auth()->user()->email)}}
                    </p>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Leave Balances</h4>
                </div>
                <table class="table card-table">
                    <tr>
                        <td width="1"><i class="fa fa-certificate"></i></td>
                        <td>Annual</td>
                        <td class="text-right"><span class="text-muted">{{auth()->user()->annual_leave}}</span></td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-book"></i></td>
                        <td>Study</td>
                        <td class="text-right"><span class="text-muted">{{auth()->user()->study_leave}}</span></td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-bed"></i></td>
                        <td>Sick Leave</td>
                        <td class="text-right"><span class="text-muted">{{auth()->user()->sick_leave}}</span></td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-bed"></i></td>
                        <td>Sick Leave Half Pay</td>
                        <td class="text-right"><span class="text-muted">{{auth()->user()->sick_leave_half_pay}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-blind"></i></td>
                        <td>Sick Leave Full Pay</td>
                        <td class="text-right"><span class="text-muted">{{auth()->user()->sick_leave_full_pay}}</span>
                        </td>
                    </tr>
                    @if(auth()->user()->gender=='female')
                        <tr>
                            <td><i class="fa fa-opera"></i></td>
                            <td>Maternity</td>
                            <td class="text-right"><span class="text-muted">{{auth()->user()->maternity_leave}}</span>
                            </td>
                        </tr>
                    @endif
                    <tr class="bg-blue-darkest text-white">
                        <td><i class="fa fa-snowflake-o"></i></td>
                        <td>Total Leave Days Available</td>
                        <td class="text-right"><span
                                class="">{{auth()->user()->total_leave_balance - auth()->user()->maternity_leave}}</span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover table-outline table-vcenter -nowrap card-table">
                        <thead>
                        <tr>
                            <th class="">ID</th>
                            <th class="">Dates</th>
                            <th class="">Other Details</th>
                            <th class="">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($leaves as $leave)
                            <tr>
                                <td class="text-primary">#{{ $leave->id }}</td>
                                <td>
                                    <div>Start : {{ $leave->start_date->format('Y-m-d') }}</div>
                                    <div>End : {{ $leave->end_date->format('Y-m-d') }}</div>
                                    <div>Days : {{ $leave->days }}</div>
                                </td>
                                <td>
                                    <div>Status : {{ $leave->status }}</div>
                                    @if($leave->document_name)
                                        <div><a target="_blank" href="/leaves/{{ $leave->id }}/download">Document : {{ $leave->document_name }}</a></div>
                                    @endif
                                </td>
                                <td class="text-center">

                                    @can('view' , $leave)
                                        <div><a href="/leaves/{{ $leave->id }}/view">View</a></div>
                                    @endcan
                                    @can('recommend' , $leave)
                                        <div><a href="/leaves/{{ $leave->id }}/recommend">Recommend</a></div>
                                    @endcan
                                    @can('authorize' , $leave)
                                        <div><a href="/leaves/{{ $leave->id }}/authorize">Authorize</a></div>
                                    @endcan
                                    @can('close' , $leave)
                                        <div><a href="/leaves/{{ $leave->id }}/close">Close</a></div>
                                    @endcan

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="mt-3 d-flex justify-content-center align-items-center">
                        {{ $leaves->render() }}
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <form action="/apply" class="card" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <h1 class="card-title">Apply Leave</h1>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label"> <span><i class="fa fa-envira"></i></span> Leave Type</label>
                        <select class="custom-select @error('leave_type') is-invalid @enderror" name="leave_type" id="leave_type">
                            <option value="">Choose Leave Type</option>
                            @foreach($leave_types as $leave_type)
                                <option {{ old('leave_type') == $leave_type->id ? 'selected' : '' }} value="{{$leave_type->id}}">{{$leave_type->name}}</option>
                            @endforeach
                        </select>
                        @error('leave_type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label"> <span><i class="fa fa-calendar"></i></span> Start Date<span
                                class="form-required">*</span></label>
                        <input type="date" class="textbox form-control  @error('start_date') is-invalid @enderror"
                               id="start_date" name="start_date" value="{{ old('start_date') }}"/>
                        @error('start_date')
                        <span class="invalid-feedback" role="alert">
                               <strong>{{ $message }}</strong>
                              </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label"> <span><i class="fe fe-sunrise"></i></span> End Date<span
                                class="form-required">*</span></label>
                        <input type="date" class="textbox form-control  @error('end_date') is-invalid @enderror"
                               id="end_date" name="end_date"  value="{{ old('end_date') }}"/>

                        @error('end_date')
                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="" class="form-label"><span><i class="fa fa-file"></i></span> Supporting
                            Document</label>
                        <input type="file" class="form-control @error('document_name') is-invalid @enderror"
                               name="document_name">
                        @error('document_name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit">Apply</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection
