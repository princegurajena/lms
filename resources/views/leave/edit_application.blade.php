@extends('layouts.main',['title'=>'','active'=>''])

@section('content')


    <br>
    <center>
        <div class="col-lg-8">
            {{--@if(session()->has('success'))
                <div class="alert alert-success alert-dismissable">
                    <span>{{ session('success') }}</span>
                </div>
            @endif--}}
            <form class="card" action='/update_leave' method="post" enctype="multipart/form-data">
                @csrf
                <div class="text-center mb-6">
                    <img src="{{asset('images/1.png')}}" class="h-15" alt="">
                    <h1 class="card-title">Edit Leave Application # {{$leaves->id}}</h1>
                </div>
                <div class="card-body">
                    <div class="input_fields_container_part">
                        <input type="hidden" name="leave_id" value="{{$leaves->id}}">
                        <div>
                            <div class="row">
                                <div class="col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <label class="form-label"> <span><i class="fa fa-envira"></i></span> Leave Type</label>
                                        <input type="text" class="form-control" value="{{$leaves->type->leave_type_name}}" disabled>
                                        {{--<select class="custom-select" name="leave_type" id="leave_type" required>
                                            <option value="" selected disabled hidden>Choose Leave Type</option>
                                            @foreach($leave_types as $leave_type)
                                                <option value="{{$leave_type->id}}">{{$leave_type->leave_type_name}}</option>
                                            @endforeach
                                        </select>--}}

                                        @error('leave_type')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-3 col-md-3">
                                    <div class="form-group">
                                        <label class="form-label"> <span><i class="fa fa-calendar"></i></span> Start Date<span class="form-required">*</span></label>
                                        <input type="date" class="textbox form-control  @error('start_date') is-invalid @enderror" value="{{$leaves->start_date}}" id="start_date" name="start_date" onchange="cal()" />
                                        @error('start_date')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                </div>


                                <div class="col-sm-3 col-md-3">
                                    <div class="form-group">
                                        <label class="form-label"> <span><i class="fe fe-sunrise"></i></span> End Date<span class="form-required">*</span></label>
                                        <input type="date" class="textbox form-control  @error('end_date') is-invalid @enderror" id="end_date" name="end_date" onchange="cal()"/>

                                        @error('end_date')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-2 col-md-2">
                                    <div class="form-group">
                                        <label class="form-label"> <span><i class="fa fa-calendar-o"></i></span> Days<span class="form-required">*</span></label>
                                        <input type="text" name="total_days_taken" placeholder="" value="{{ old('row[0][end_date]') }}" class="form-control" required id="difference"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(auth()->user()->getRoleNames()[0]=='General' )
                    <div class="row">
                        <div class="col-sm-4 col-md-4" id="myDiv">
                            <div class="form-group">
                                <label for="" class="form-label"><span><i class="fa fa-file"></i></span> Supporting Document</label>
                                <input type="file" class="form-control @error('document_name') is-invalid @enderror" name="document_name">
                                @error('document_name')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                        </div>
                            <div class="col-sm-3 col-md-3">
                                <div class="form-group">
                                    <label class="form-label"> <span><i class="fa fa-user"></i></span>Supervisor</label>
                                    <select class="custom-select" name="supervisor">
                                        @foreach($supervisors as $supervisor)
                                            <option value="{{$supervisor->id}}">{{$supervisor->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                    </div>
                    @endif
                </div>
                <div class="card-footer text-right">
                    <button type="submit" name='submit' class="btn btn-outline-danger btn-sm" ><i class="fe fe-log-in"></i>Apply Leave</button>
                </div>

            </form>

        </div>
    </center>
@section('js')

    <script type="text/javascript">
        function GetDays(){
            var dropdt = new Date(document.getElementById("end_date").value);
            var pickdt = new Date(document.getElementById("start_date").value);
            return parseInt((dropdt - pickdt) / (24 * 3600 * 1000));
        }

        function cal(){
            if(document.getElementById("end_date")){
                document.getElementById("difference").value=GetDays();
            }
        }
        function myFunction() {
            var x = document.getElementById("myDiv");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

    </script>



@endsection
@endsection

