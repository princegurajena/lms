@extends('layouts.main',['title'=>'','active'=>''])

@section('content')

    <div class="page-header">
        <h1 class="page-title">
           Leave Statistics for {{auth()->user()->location->location_name}}
        </h1>
    </div>
   <div>

   </div>

    <div class="row row-cards">

        <div class="col-lg-6 col-xl-6">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h3 class="card-title">Leave Applications for {{auth()->user()->location->location_name}}</h3>
                </div>
                <div class="card-body">
                    <table class="table card-table">
                        @foreach($data3 as $applicants)
                            <tr>
                                <td>{{$applicants->user->name}}</td>
                                <td class="text-right">
                                    <span class="badge badge-danger">{{$applicants->count}}</span>
                                </td>
                            </tr>
                        @endforeach

                    </table>
                    <div class="row justify-content-center">
                        <div class="col-3 text-center">
                            {{--                            <div class="text-center">{{$leaves->links()}}</div>--}}
                            {!! $data3->appends(\Request::except('page'))->render() !!}
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-6 col-xl-6">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h3 class="card-title">Leave Applications for {{auth()->user()->location->location_name}}</h3>
                </div>
                <div class="card-body">
                    <div  style="">
                        {!! $chart->container() !!}
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-6 col-xl-6">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h3 class="card-title">Requests</h3>
                </div>
                <div class="card-body">
                    <div  style="">
                        {!! $chart2->container() !!}
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-6 col-xl-6">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h3 class="card-title">Most Applied Leave Types</h3>
                </div>
                <div class="card-body">
                    <div  style="">
                        {!! $chart3->container() !!}
                    </div>
                </div>
            </div>

        </div>
    </div>

    {!! $chart->script() !!}
    {!! $chart2->script() !!}
    {!! $chart3->script()  !!}
@endsection