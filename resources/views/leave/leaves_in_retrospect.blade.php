@extends('layouts.main',['title'=>'','active'=>''])

@section('content')
    <br>
    <center>
        <div class="col-lg-8">
            <form class="card" action='/leave_retrospect_application' method="post" enctype="multipart/form-data">
                @csrf
                <div class="text-center mb-6">
                    <img src="{{asset('images/1.png')}}" class="h-15" alt="">
                    <h1 class="card-title">Leave Application Form</h1>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div  id="ERROR_COPY" class="alert alert-danger" style="display: none">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li style="list-style:none">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="input_fields_container_part">
                        <div>
                            <div class="row">
                                <div class="col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <label class="form-label"> <span><i class="fa fa-envira"></i></span> Leave Type</label>
                                        <select class="custom-select" name="leave_type" required>
                                            <option value="" selected disabled hidden>Choose Leave Type</option>
                                            @foreach($leave_types as $leave_type)
                                                <option value="{{$leave_type->id}}">{{$leave_type->leave_type_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-3 col-md-3">
                                    <div class="form-group">
                                        <label class="form-label"> <span><i class="fa fa-calendar"></i></span> Start Date<span class="form-required">*</span></label>
                                        <input type="date" class="form-control" placeholder="Start Date" name="start_date" value="{{ old('row[0][start_date]') }}" required>

                                    </div>
                                </div>


                                <div class="col-sm-3 col-md-3">
                                    <div class="form-group">
                                        <label class="form-label"> <span><i class="fa fa-calendar"></i></span> End Date<span class="form-required">*</span></label>
                                        <input type="date" name="end_date" placeholder="End Date" value="{{ old('row[0][end_date]') }}" class="form-control" required/>
                                    </div>
                                </div>
                                <div class="col-sm-2 col-md-2">
                                    <div class="form-group">
                                        <label class="form-label"> <span><i class="fa fa-calendar"></i></span> Action<span class="form-required">*</span></label>
                                        <button class="btn btn-outline-success add_more_button"><i class="fe fe-arrow-down-circle"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-md-12" >
                            <div class="form-group mb-0">
                                <label class="form-label">Brief Description<span class="form-required">(optional)</span></label>
                                <textarea rows="5" class="form-control" name='reason' placeholder="Here can be your description"  value="" ></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-right">
                    <button type="submit" name='submit' class="btn btn-outline-danger btn-sm" ><i class="fe fe-log-in"></i>Apply Leave</button>
                </div>

            </form>

        </div>
    </center>
@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        var has_errors = {{$errors->count()>0?'true':'false'}};
        if(has_errors){
            Swal.fire({
                title: 'Error submitting',
                type: 'error',
                html: jQuery("#ERROR_COPY").html(),
                showCloseButton: true,
                showConfirmButton: true,

            })
        }

    </script>
    <script>
        $(document).ready(function() {


            var max_fields_limit      = 5; //set limit for maximum input fields
            var leave_types = {!! json_encode($leave_types->toArray()) !!};



            var x = 1; //initialize counter for text box
            $('.add_more_button').click(function(e){ //click event on add more fields button having class add_more_button
                e.preventDefault();
                if(x < max_fields_limit){ //check conditions
                    x++; //counter increment
                    var select = '<select class="custom-select" name="row['+x+'][leave_type]" required> <option value="" selected disabled hidden>Choose Leave Type</option>';
                    for(var i = 0; i < leave_types.length; i++){
                        select+='<option value="'+leave_types[i]['id']+'">'+leave_types[i]['leave_type_name']+'</option>';

                    };
                    select += '</select>';
                    $('.input_fields_container_part').append(

                        '<div>    <div class="row">\n' +
                        '                                    <div class="col-sm-4 col-md-4">\n' +
                        '                                        <div class="form-group">\n' +
                        select+
                        '                                        </div>\n' +
                        '                                    </div>\n' +
                        '\n' +
                        '                                    <div class="col-sm-3 col-md-3">\n' +
                        '                                        <div class="form-group">\n' +
                        '                                            <input type="date" class="form-control" placeholder="start_date" name="row['+x+'][start_date]" value="" required>\n' +
                        '\n' +
                        '                                        </div>\n' +
                        '                                    </div>\n' +
                        '\n' +
                        '\n' +
                        '                                    <div class="col-sm-3 col-md-3">\n' +
                        '                                        <div class="form-group">\n' +
                        '                                            <input type="date" class="form-control" placeholder="end_date" name="row['+x+'][end_date]" value="" required>\n' +
                        '                                        </div>\n' +
                        '                                    </div>\n' +
                        '<a href="#" class="col-sm-2 col-md-2 btn btn-sm remove_field text-danger"><i class="fa fa-trash"></i> Remove</a></div></div>'); //add input field
                }
            });
            $('.input_fields_container_part').on("click",".remove_field", function(e){ //user click on remove text links
                e.preventDefault(); $(this).parent('div').remove(); x--;
            })
        });
    </script>
@endsection
@endsection

