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
        <div class="col-lg-12">
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
    </div>


@endsection
