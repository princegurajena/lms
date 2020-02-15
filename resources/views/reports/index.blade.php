@extends('layouts.main',['title'=>'','active'=>''])

@section('content')
    <div class="row p-0">
        <div class="col-lg-12">
            @if(session()->has('message'))
                <div class="alert alert-success rounded-0 text-center">
                    {{ session()->get('message') }}
                </div>
            @endif
        </div>
        <div class="col-lg-12 mb-3">
            <div class="card card-body">
                <form method="get" class="row align-items-center">
                    <div class="col-lg-3">
                        <label>Type</label>
                        <select class="form-control" name="type" type="text">
                            <option value="">Choose Leave Type</option>
                            @foreach($leave_types as $leave_type)
                                <option {{ old('leave_type') == $leave_type->id ? 'selected' : '' }} value="{{$leave_type->id}}">{{$leave_type->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label>Start</label>
                       <input class="form-control" name="start" type="date" value="{{ request('start') }}">
                    </div>
                    <div class="col-lg-3">
                        <label>End</label>
                        <input class="form-control" name="end" type="date" value="{{ request('end') }}">
                    </div>
                    <div class="col-lg-2">
                        <label style="visibility: hidden;display: block">Start</label>
                        <button type="submit" class="btn btn-primary btn-block">Filter</button>
                    </div>
                    <div class="col-lg-1">
                        <label style="visibility: hidden;display: block">Start</label>
                        <button name="run" type="submit" class="btn btn-primary btn-block">Run</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row text-center justify-content-around px-5">
                        <div class="col col-auto">
                            <h2 class="mb-1">{{ $total }}</h2>
                            <div class="text-muted-dark">
                                <span class="card-link">Total</span>
                            </div>
                        </div>
                        @foreach($completed as $complete)
                            <div class="col col-auto">
                                <h2 class="mb-1">{{ $complete['count'] }}</h2>
                                <div class="text-muted-dark">
                                    <span class="card-link">{{ $complete['completed'] ? 'Completed' : 'Pending'}}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 row">
            @foreach($types as $type)
                <div class="col-6">
                    <div class="card">
                        <div class="card-body p-3 text-center">
                            <div class="h1 m-0">{{ $type['count'] }}</div>
                            <div class="text-muted mt-2">{{ $type['name'] }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover table-outline table-vcenter -nowrap card-table">
                        <thead>
                        <tr>
                            <th class="">ID</th>
                            <th class="">Start</th>
                            <th class="">Days</th>
                            <th class="">Status</th>
                            <th class="">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($leaves as $leave)
                            <tr>
                                <td class="text-primary">#{{ $leave->id }}</td>
                                <td>
                                    <div>Start : {{ $leave->start_date->format('Y-m-d') }}</div>
                                </td>
                                <td>
                                    <div>Days : {{ $leave->days }}</div>
                                </td>
                                <td>
                                    <div>Status : {{ $leave->status }}</div>
                                </td>
                                <td class="text-center">
                                    @can('view' , $leave)
                                        <div><a href="/leaves/{{ $leave->id }}/view">View</a></div>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 ">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Locations</h4>
                </div>
                <div class="table-responsive" style="height: 20rem;">
                    <table class="table card-table table-vcenter">
                        <tbody>
                        @foreach($locations as $location)
                            <tr>
                                <td>
                                    <span>{{ $location['location_name'] }}</span>
                                </td>
                                <td class="text-right"><span class="text-muted">{{ $location['count'] }}</span>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 ">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Pending Supervisors</h4>
                </div>
                <div class="table-responsive" style="height: 20rem;">
                    <table class="table card-table table-vcenter">
                        <tbody>
                        @foreach($supervisor as $applicant)
                            <tr>
                                <td>
                                    <span class="text-primary">{{ $applicant['supervisor_email'] }}</span>
                                </td>
                                <td class="text-right"><span class="text-muted">{{ $applicant['count'] }}</span>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 ">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Top Applicants</h4>
                </div>
                <div class="table-responsive" style="height: 20rem;">
                    <table class="table card-table table-vcenter">
                        <tbody>
                        @foreach($applications as $applicant)
                            <tr>
                                <td>
                                    <span class="text-primary">{{ $applicant['email'] }}</span>
                                </td>
                                <td class="text-right"><span class="text-muted">{{ $applicant['count'] }}</span>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>



    </div>


@endsection
