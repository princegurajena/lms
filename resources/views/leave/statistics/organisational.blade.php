@extends('layouts.main',['title'=>'','active'=>''])

@section('content')
    <div class="row">
        <div class="col-sm-6 col-lg-3">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-warning mr-3">
                      <i class="fe fe-sunrise"></i>
                    </span>
                    <div>
                        <h4 class="m-0"><a href="javascript:void(0)">{{$stats[0]->count}}<small> Leaves</small></a></h4>
                        <small class="text-muted">{{$stats[0]->status->status_name}}</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-blue mr-3">
                      <i class="fa fa-book"></i>
                    </span>
                    <div>
                        <h4 class="m-0"><a href="javascript:void(0)">{{$stats[1]->count}} <small> Leaves</small></a></h4>
                        <small class="text-muted">{{$stats[1]->status->status_name}}</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-2">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-green mr-3">
                      <i class="fe fe-check-circle"></i>
                    </span>
                    <div>
                        <h4 class="m-0"><a href="javascript:void(0)">{{$stats[2]->count}} <small> Leaves</small></a></h4>
                        <small class="text-muted">{{$stats[2]->status->status_name}}</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-2">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-red mr-3">
                      <i class="fa fa-thumbs-down"></i>
                    </span>
                    <div>
                        <div class="pull-left">
                            <h4 class="m-0"><a href="javascript:void(0)">{{$stats[3]->count}} <small></small></a></h4>
                            <small class="text-muted pull-left">{{$stats[3]->status->status_name}}</small>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-2">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-red mr-3">
                      <i class="fa fa-times-circle"></i>
                    </span>
                    <div>
                        <div class="pull-left">
                            <h4 class="m-0"><a href="javascript:void(0)">{{$stats[4]->count}} <small></small></a></h4>
                            <small class="text-muted pull-left">{{$stats[4]->status->status_name}}</small>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Top Applications from Departments</h4>
            </div>
            <table class="table card-table">
                @foreach($leaves as $leave)
                <tr>
                    <td width="1"><i class="fa fa-bank text-muted"></i></td>
                    <td>{{$leave->location->location_name}}</td>
                    <td class="text-right"><span class="text-muted">{{$leave->count}}</span></td>
                </tr>
                @endforeach
            </table>
            <div class="row justify-content-center">
                <div class="text-center">
                    {!! $leaves->appends(\Request::except('page'))->render() !!}

                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Stats By Department</h4>
            </div>

            <div class="card-body">
                {!! $chart->container() !!}
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6 col-lg-6">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h4 class="card-title">Individuals with Most Applications</h4>
            </div>
            <table class="table card-table">
                @foreach($leaves_count as $count)
                <tr>
                    <td width="1"><i class="fa fa-user text-muted"></i></td>
                    <td>{{$count->user->name}}</td>
                    <td class="text-right"><span class="text-muted">{{$count->count}}</span></td>
                </tr>
                    @endforeach

            </table>
            <div class="justify-content-center">
                <div class="text-center">
                    {!! $leaves_count->appends(\Request::except('page'))->render() !!}
                </div>
            </div>
        </div>

    </div>
    <div class="col-sm-6 col-lg-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h2 class="card-title">Supervisors with Pending Requests</h2>
            </div>
            <table class="table card-table">
                @foreach($leaves_count_supervisor as $count)
                <tr>
                    <td>{{$count->supervisor->name}}</td>
                    <td class="text-right">
                        <span class="badge badge-danger">{{$count->count}}</span>
                    </td>
                </tr>
            @endforeach

            </table>
            <div class="row justify-content-center">
                <div class="col-3 text-center">

                    {!! $leaves_count_supervisor->appends(\Request::except('page'))->render() !!}
                </div>
            </div>

        </div>
    </div>
    <div class="col-md-6 col-lg-6">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h3 class="card-title">Authorizers with Pending Requests</h3>
            </div>
            <div class="card-body o-auto" style="height: 15rem">
                <ul class="list-unstyled list-separated">
                    @foreach($leaves_count_head as $count)
                    <li class="list-separated-item">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="avatar avatar-md d-block" style="background-image: url('{{ asset('images/logo.png') }}')"></span>
                            </div>
                            <div class="col">
                                <div>
                                    <a href="javascript:void(0)" class="text-inherit">{{$count->head->name}}</a>
                                    <span class="badge badge-danger pull-right">{{$count->count}}</span>
                                </div>
                                <small class="d-block item-except text-sm text-muted h-1x">{{$count->head->email}}</small>
                            </div>

                        </div>
                    </li>
                        @endforeach

                        <div class="row justify-content-center">
                            <div class="col-3 text-center">
                                {!! $leaves_count_head->appends(\Request::except('page'))->render() !!}
                            </div>
                        </div>

                </ul>
            </div>
        </div>
    </div>
</div>
{!! $chart->script() !!}
@endsection