@extends('layouts.main',['title'=>'','active'])

@section('content')
    <form action="/individual_requests" method="GET">
    <div class="row row-cards row-deck">
            @csrf
            <div class="col-sm-3 col-md-3">
                <div class="form-group">

                    <input type="text" name="search" placeholder="search keyword" value="{{isset($search) ? $search : '' }}" class="form-control"/>
                </div>
            </div>



            <div class="col-sm-2 col-md-2">
                <div class="form-group">

                    <button type="submit" class="btn btn-outline-danger"><i class="fe fe-upload mr-2"></i>Search</button>
                </div>
            </div>
    </div>
        </form>


        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                        <thead>
                        <tr>
                            <th class="text-center w-1"><i class="icon-people"></i></th>
                            <th class="text-dark">@sortablelink('id','ID',['filter' => 'active, visible'], ['class' => 'text-dark', 'rel' => 'nofollow'])</th>
                            <th class="text-dark">@sortablelink('leave_type_id','Leave Type',['filter' => 'active, visible'], ['class' => 'text-dark', 'rel' => 'nofollow'])</th>
                            <th class="text-center text-dark">@sortablelink('start_date','Start Date',['filter' => 'active, visible'], ['class' => 'text-dark', 'rel' => 'nofollow'])</th>
                            <th class="text-dark">@sortablelink('end_date','End Date',['filter' => 'active, visible'], ['class' => 'text-dark', 'rel' => 'nofollow'])</th>
                            <th class="text-dark">Other Details</th>
                            <th class="text-center text-dark">Status</th>
                            <th class="text-center text-dark"><i class="icon-settings"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($leaves as $leave)
                            @if($leave->user_id==auth()->user()->id)
                            <tr>
                                <td class="text-center">
                                    @if($leave->status_id==1)
                                        <div class="avatar d-block" style="background-image: url('{{ asset('images/logo.png') }}')">
                                            <span class="avatar-status bg-yellow"></span>
                                            @endif

                                            @if($leave->status_id==2||$leave->status_id==3)
                                                <div class="avatar d-block" style="background-image: url('{{ asset('images/logo.png') }}')">
                                                    <span class="avatar-status bg-green"></span>
                                                    @endif

                                                    @if($leave->status_id==4||$leave->status_id==5)
                                                        <div class="avatar d-block" style="background-image: url('{{ asset('images/logo.png') }}')">
                                                            <span class="avatar-status bg-red"></span>
                                                            @endif
                                                        </div>
                                                </div></div>
                                </td>
                                <td>
                                    <div>{{$leave->id}}</div>


                                </td>
                                <td>
                                    <div>{{$leave->type->leave_type_name}}</div>
                                </td>
                                <td class="text-center">
                                    <div>{{$leave->start_date->format('D j, F Y')}}</div>

                                </td>
                                <td>

                                    <div>{{$leave->end_date->format('D j, F Y')}}</div>
                                </td>
                                <td>
                                    <small> <div class="text-muted">Date Applied: {{$leave->created_at->format('D j, F Y, g:i a')}}</div></small>
                                    <small><div class="text-muted">Supervisor : {{$leave->supervisor->name}}</div></small>
                                    <small><div class="text-muted">Head : {{$leave->head->name}}</div></small>
                                    <small><div class="text-muted">Location : {{ucwords($leave->location['location_name'])}}</div></small>
                                    <small><div class="text-muted">Status Description : {{$leave->status->status_name}}</div></small>
                                </td>
                                <td class="text-center">
                                    @if($leave->status_id==1||$leave->status_id==2)
                                        <div><span class="tag tag-yellow">Pending</span></div>
                                    @endif

                                    @if($leave->status_id==3)
                                        <div><span class="tag tag-green">Authorized</span></div>
                                    @endif

                                    @if($leave->status_id==4)
                                        <div><span class="tag tag-red">{{$leave->status->status_name}}</span></div>
                                    @endif

                                    @if($leave->status_id==5)
                                        <div><span class="tag  tag-gray-dark">{{$leave->status->status_name}}</span></div>
                                    @endif
                                </td>
                            </tr>

                            @endif
                        @endforeach
                        </tbody>
                    </table>

                    <div class="row justify-content-center">
                        <div class="col-3 text-center">
                            {{--                            <div class="text-center">{{$leaves->links()}}</div>--}}
                            {!! $leaves->appends(\Request::except('page'))->render() !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection