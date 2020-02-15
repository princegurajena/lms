@extends('layouts.main',['title'=>'','active'=>''])

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1 class="page-title">
                    View Leave
                </h1>
            </div>

        </div>
        <div class="col-lg-12">
            @if(session()->has('message'))
                <div class="alert alert-success rounded-0 text-center">
                    {{ session()->get('message') }}
                </div>
            @endif
        </div>
        <div class="col-lg-6">
            <div class="card">
                <table class="table card-table">
                    <tbody>
                    <tr><td class="text-muted">Requester : </td><td class="text-right">{{ $leave->user->name }} {{ $leave->user->last_name }} : {{ $leave->user->email }}</td></tr>
                    <tr><td class="text-muted">Supervisor : </td><td class="text-right">{{ $leave->supervisor_email }}</td></tr>
                    <tr><td class="text-muted">Start Date : </td><td class="text-right">{{ $leave->start_date }}</td></tr>
                    <tr><td class="text-muted">End Date : </td><td class="text-right">{{ $leave->end_date }}</td></tr>
                    <tr><td class="text-muted">Days : </td><td class="text-right">{{ $leave->days }}</td></tr>
                    <tr><td class="text-muted">Status : </td><td class="text-right">{{ $leave->status }}</td></tr>
                        @if($leave->document_name)
                            <tr><td class="text-muted">Document : </td><td class="text-right"><a target="_blank" href="/leaves/{{ $leave->id }}/download">{{ $leave->document_name }}</a></td></tr>
                         @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Timeline</h4>
                    </div>
                    <table class="table card-table">
                        <tbody>
                        @foreach($leave->timeline as $item)
                            <tr>
                                <td class="text-primary">{{ $item->email }}</td>
                                <td>{{ $item->event }}</td>
                                <td class="text-right">
                                   {{ $item->created_at->diffForHumans() }}
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
