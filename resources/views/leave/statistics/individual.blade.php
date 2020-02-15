@extends('layouts.main',['title'=>'','active'=>''])

@section('content')
    <div class="row row-cards">
        <div class="col-6 col-sm-4 col-lg-2">
            <div class="card bg-success">
                <div class="card-body p-3 text-center text-white">
                    <div class="text-right text-green">

                        <i class="fe fe-chevron-up"></i>
                    </div>
                    <div class="h1 m-0">{{auth()->user()->annual_leave}}</div>
                    <div class="mb-4">Annul Leave</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-lg-2">
            <div class="card bg-danger text-white">
                <div class="card-body p-3 text-center">
                    <div class="text-right text-red">

                        <i class="fe fe-chevron-down"></i>
                    </div>
                    <div class="h1 m-0">{{auth()->user()->study_leave}}</div>
                    <div class="mb-4">Study Leave</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-lg-2">
            <div class="card bg-primary text-white">
                <div class="card-body p-3 text-center">
                    <div class="text-right text-primary">

                        <i class="fe fe-chevron-up"></i>
                    </div>
                    <div class="h1 m-0">{{auth()->user()->sick_leave_half_pay}}</div>
                    <div class="mb-4">Sick Leave Half Pay</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-lg-2">
            <div class="card bg-info text-white">
                <div class="card-body p-3 text-center">
                    <div class="text-right text-info">

                        <i class="fe fe-chevron-up"></i>
                    </div>
                    <div class="h1 m-0">{{auth()->user()->sick_leave_full_pay}}</div>
                    <div class="mb-4">Sick Leave Full Pay</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-lg-2">
            <div class="card bg-warning text-white">
                <div class="card-body p-3 text-center">
                    <div class="text-right text-warning">

                        <i class="fe fe-chevron-down"></i>
                    </div>
                    @if(auth()->user()->gender=='female')
                    <div class="h1 m-0">{{auth()->user()->maternity_leave}}</div>

                    @endif

                    @if(auth()->user()->gender!='female')
                        <div class="h1 m-0">Nill</div>
                        <div class="mb-4">Maternity</div>
                    @endif


                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-lg-2">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <div class="text-right text-white">

                        <i class="fe fe-chevron-down"></i>
                    </div>
                    <div class="h1 m-0">{{auth()->user()->total_leave_balance}}</div>
                    <div class="mb-4">Total</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-cards">
        <div class="col-lg-6 col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Success Rate Of My Applications</h3>
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
                <div class="card-header">
                    <h3 class="card-title">Most Applied Leave Types</h3>
                </div>
                <div class="card-body">
                    <div  style="">
                        {!! $chart2->container() !!}
                    </div>
                </div>
            </div>

        </div>
    </div>



    {!! $chart->script() !!}
    {!! $chart2->script() !!}

@endsection