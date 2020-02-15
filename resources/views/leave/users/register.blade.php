@extends('layouts.main',['title'=>'','active'=>''])

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-9 text-center">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Register New User</h3>
                </div>
                <div class="card-body">
                    <form action="register_user" method="post">
                        @csrf
                        <div class="row">

                            <div class="form-group col-sm-3 col-md-3">
                                <label class="form-label">
                                    Employee Number <span class="form-required">*</span>
                                </label>
                                <input name="emp_num" type="text" class="form-control @error('emp_num') is-invalid @enderror" value="" placeholder="Employee Number" required>
                                @error('emp_num')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-sm-5 col-md-5">
                                <label class="form-label">
                                    First Name<span class="form-required">*</span>
                                </label>
                                <input name="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" value=""  placeholder="First Name" required>
                                @error('firstname')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-sm-4 col-md-4">
                                <label class="form-label">
                                    LastName <span class="form-required">*</span>
                                </label>
                                <input name="surname" type="text" class="form-control @error('surname') is-invalid @enderror" value=""  placeholder="Last name" required>
                                @error('surname')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">

                            <div class="form-group col-sm-4 col-md-4">
                                <label class="form-label">
                                    UserName<span class="form-required">*</span>
                                </label>
                                <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" value=""  placeholder="Username" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-sm-4 col-md-4">
                                <label class="form-label">
                                    Email<span class="form-required">*</span>
                                </label>
                                <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" value=""  placeholder="Email" onchange="email_find()" id="email_org" required>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-sm-4 col-md-4">
                                <label class="form-label"> <span><i class="fa fa-calendar-o"></i></span>Location<span class="form-required">*</span></label>
                                <select class="custom-select" name="location_name" required>
                                    <option value="" selected disabled hidden>Choose Location</option>
                                    @foreach($locations as $location)
                                        <option value="{{$location->id}}">{{$location->location_name}}</option>
                                    @endforeach

                                </select>
                                @error('location_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4 col-md-4">
                                <label class="form-label">Gender</label>
                                <select class="custom-select @error('gender') is-invalid @enderror" name="gender" required>
                                    <option value="" selected disabled hidden>Choose Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>

                                @error('gender')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-sm-4 col-md-4">
                                <label class="form-label">
                                    Mobile Number<span class="form-required">*</span>
                                </label>
                                <input name="mobile_number" type="text" class="form-control @error('mobile_number') is-invalid @enderror" value=""  placeholder="Mobile Number" required>
                                @error('mobile_number')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-sm-4 col-md-4">
                                <label class="form-label">
                                    Office Number<span class="form-required">*</span>
                                </label>
                                <input name="office_number" type="text" class="form-control @error('office_number') is-invalid @enderror" value=""  placeholder="Office Number" required>
                                @error('office_number')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">

                            <div class="form-group col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label class="form-label">
                                        Job Title<span class="form-required">*</span>
                                    </label>
                                    <input name="job_title" type="text" class="form-control @error('job_title') is-invalid @enderror" value=""  placeholder="Job Title" required>
                                    @error('job_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            @if(auth()->user()->getRoleNames()[0]!='Supervisor')
                                <div class="form-group col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <label class="form-label"> <span><i class="fa fa-email"></i></span> Supervisor's Email Address</label>
                                        <input name="supervisor" type="email" class="form-control @error('email') is-invalid @enderror" value=""  placeholder="Email" onchange="email_find()" required>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            <div class="form-group col-sm-4 col-md-4">
                                <label class="form-label"> <span><i class="fa fa-calendar-o"></i></span>System Role<span class="form-required">*</span></label>
                                <select class="custom-select" name="role" required>
                                    <option value="" selected disabled hidden>Choose System Role</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->name}}">{{$role->name}}</option>
                                    @endforeach

                                </select>
                                @error('location_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12">
                                <label class="form-label">
                                    Address<span class="form-required">*</span>
                                </label>
                                <textarea name="address" type="text" class="form-control @error('address') is-invalid @enderror" value=""  placeholder="Address" required>

                                </textarea>
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-label">Leave Balances</div>
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                <tr>
                                    <th class="pl-0">Study</th>
                                    <th>Sick Full Pay</th>
                                    <th>Sick Half Pay</th>
                                    <th>Sick Leave</th>
                                    <th>Maternity</th>
                                    <th>Annual</th>
                                    <th class="pr-0">Total</th>
                                </tr>
                                </thead>
                                <tr>
                                    <td class="pr-0">
                                        <input type="number" class="form-control" id="bal1" name="study_leave" onchange="cal()" required></td>
                                        @error('study_leave')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </td class="pr-0">
                                    <td>
                                        <input type="number" class="form-control" id="bal2" name="sick_leave_full_pay" onchange="cal()" required></td>
                                    @error('sick_leave_full_pay')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <td class="pr-0">
                                        <input type="number" class="form-control" id="bal3" name="sick_leave_half_pay" onchange="cal()" required></td>
                                    @error('sick_leave_half_pay')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    </td>
                                    <td class="pr-0">
                                        <input type="number" class="form-control" value="" id="bal4" name="sick_leave" onchange="cal()" required>
                                        @error('compassionate')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </td>
                                    <td class="pr-0">
                                        <input type="number" class="form-control" value="" id="bal5" name="maternity_leave" onchange="cal()" required>
                                        @error('maternity')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror

                                    </td>
                                    <td class="pr-0">
                                        <input type="number" class="form-control" value="" id="bal6" name="annual_leave" onchange="cal()" required>
                                        @error('annual')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </td>
                                    <td class="pr-0">
                                        <input type="number" class="form-control" value="" id="total" name="total_leave_balance" >
                                    </td>
                                </tr>


                            </table>
                        </div>

                        <div class="form-label">Log In credentials</div>
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                <tr>
                                    <th class="pl-0">Email</th>
                                    <th>Password</th>
                                    <th>Confirm Password</th>
                                </tr>
                                </thead>
                                <tr>

                                    <td class="pr-0">
                                        <input type="email" class="form-control" value="" id="email_final" name=""  readonly>

                                    </td>
                                    <td class="pr-0">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="password" placeholder="New Password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </td>
                                    <td class="pr-0">
                                        <input  id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="password_confirmation" placeholder="Confirm New Password">
                                    </td>

                                </tr>


                            </table>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Register New User</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>

@section('js')
    <script type="text/javascript">
        function findemail(){
            var mail = document.getElementById("email_org").value;
            console.log(mail);
            return mail;
        }
        function email_find(){
            if(document.getElementById('email_org')){
                document.getElementById("email_final").value=findemail();
            }
        }
        function Calculate(){
            var bal1 = parseInt(document.getElementById("bal1").value);
            var bal2 = parseInt(document.getElementById("bal2").value);
            var bal3 = parseInt(document.getElementById("bal3").value);
            var bal4 = parseInt(document.getElementById("bal4").value);
            var bal5 = parseInt(document.getElementById("bal5").value);
            var bal6 = parseInt(document.getElementById("bal6").value);

            return parseInt(bal1+bal2+bal3+bal4+bal5+bal6);
        }

        function cal(){
            if(document.getElementById("bal1")||document.getElementById("bal2")||document.getElementById("bal3")||document.getElementById("bal4")||document.getElementById("bal5")||document.getElementById("bal6")){
                document.getElementById("total").value=Calculate();
            }
        }

    </script>
@endsection
@endsection