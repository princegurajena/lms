@extends('layouts.main',['title'=>'','active'])

@section('content')
    <div class="row row-cards row-deck">
        <form action="/departmental_requests" method="GET">
            <div class="row row-cards row-deck">
                @csrf
                <div class="col-sm-10 col-md-10">
                    <div class="form-group">

                        <input type="text" name="search" placeholder="search keyword" value="{{isset($search) ? $search : '' }}" class="form-control"/>
                    </div>
                </div>



                <div class="col-sm-2 col-md-2">
                    <div class="form-group">

                        <button type="submit" class="btn btn-outline-dark"><i class="fe fe-upload mr-2"></i>Search</button>
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
                            @if($leave->location_id==auth()->user()->location_id)
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
                                                </div></div></td>
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
                                    <small><div class="text-muted">Applicant : {{$leave->user->name}}</div></small>
                                    <small><div class="text-muted">Date Applied: {{$leave->created_at->format('D j, F Y, g:i a')}}</div></small>
                                    <small><div class="text-muted">Supervisor : {{$leave->supervisor->name}}</div></small>
                                    <small><div class="text-muted">Head : {{$leave->head->name}}</div></small>
                                    <small><div class="text-muted">Location : {{ucwords($leave->location['location_name'])}}</div></small>
                                    <small><div class="text-muted">Status Description: {{$leave->status->status_name}}</div></small>
                                    <small>
                                        @if($leave->leave_type_id == 2 || $leave->leave_type_id == 3 || $leave->leave_type_id == 5)
                                            <div class="text-muted">
                                                Supporting Documents: <a href="/download_document/{{$leave->id}}">{{$leave->document_real_name}}</a>
                                            </div>
                                        @endif
                                    </small>

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
                                <td>

                                <div class="item-action dropdown">
                                    <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        {{--@if(auth()->user()->getRoleNames()[0]=='Supervisor' && $leave->status_id==1 && $leave->location_id==auth()->user()->location_id)--}}
                                        @can('recommend')
                                            @if($leave->status_id==1 && $leave->location_id==auth()->user()->location_id)
                                                <a href="/edit_application/{{$leave->id}}" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i> Edit Application</a>
                                                <a href="/recommend/{{$leave->id}}" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Recommend</a>
                                            @endif
                                        @endcan
                                        {{--@endif--}}

                                        {{--@if(auth()->user()->getRoleNames()[0]=='Head Of Department' && $leave->status_id==2 && $leave->location_id==auth()->user()->location_id)--}}
                                        @can('authorize','reject')
                                            @if($leave->status_id==2 && $leave->location_id==auth()->user()->location_id)
                                                <a href="/authorize/{{$leave->id}}" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i> Authorize </a>
                                                <a href="/reject/{{$leave->id}}" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i> Reject </a>
                                            @endif
                                        @endcan
                                            {{--@endif--}}

                                            {{--@if(auth()->user()->getRoleNames()[0]=='Head Of Department' )--}}
                                        @can('close')
                                            @if($leave->status_id==1 or $leave->status_id==2)
                                                <a href="/close/{{$leave->id}}" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i>Close</a>
                                            @endif
                                        @endcan
                                            {{--@endif--}}

                                        @if($leave->status_id>=3)
                                            <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i>Please note that this leave application was {{$leave->status->status_name}}</a>
                                        @endif

                                    </div>
                                </div>

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