@extends('layouts.main',['title'=>'','active'=>''])

@section('content')
    <div class="row">
        <div class="col-lg-3">
            <div class="card card-profile">
                <div class="card-header" style="background-image: url('{{asset('images/pic2.jpeg')}}');"></div>
                <div class="card-body text-center">
                    <img class="card-profile-img" style="height: 100px;width: 100px" src="{{asset('images/avatar.png')}}">
                    <h3 class="mb-3">{{$user->name}} {{$user->last_name}}</h3>
                    <small class="text-muted d-block mt-1">{{ $user->job_title }}</small>

                </div>
            </div>
            <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Leave Balances</h4>
                    </div>
                    <table class="table card-table">
                        <tr>
                            <td width="1"><i class="fa fa-certificate"></i></td>
                            <td>Annual</td>
                            <td class="text-right"><span class="text-muted">{{auth()->user()->annual_leave}}</span></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-book"></i></td>
                            <td>Study</td>
                            <td class="text-right"><span class="text-muted">{{auth()->user()->study_leave}}</span></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-bed"></i></td>
                            <td>Sick Leave Half Pay</td>
                            <td class="text-right"><span class="text-muted">{{auth()->user()->sick_leave_half_pay}}</span></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-blind"></i></td>
                            <td>Sick Leave Full Pay</td>
                            <td class="text-right"><span class="text-muted">{{auth()->user()->sick_leave_full_pay}}</span></td>
                        </tr>
                        @if(auth()->user()->gender=='female')
                        <tr>
                            <td><i class="fa fa-opera"></i></td>
                            <td>Maternity</td>
                            <td class="text-right"><span class="text-muted">{{auth()->user()->maternity_leave}}</span></td>
                        </tr>
                        @endif
                        <tr class="bg-blue-darkest text-white">
                            <td><i class="fa fa-snowflake-o"></i></td>
                            <td>Total Leave Days Available</td>
                            <td class="text-right"><span class="">{{auth()->user()->user_leave_balance}}</span></td>
                        </tr>
                    </table>
                </div>



        </div>
        <div class="col-lg-9">
            <form class="card"  method="post">
                @if(session()->has('message'))
                    <div class="card-alert alert alert-success text-center">
                       {{ session()->get('message') }}
                    </div>
                @endif
                @csrf
                <div class="card-body">
                    <h3 class="card-title">Edit Profile</h3>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="emp_num" class="form-label">Employee Number</label>
                                <input type="text" name="emp_num" id="emp_num" class="form-control {{ $errors->has('emp_num') ? ' is-invalid' : '' }}" value="{{ old('emp_num',$user->emp_num) }}">
                                @error('emp_num')
                                     <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="job_title" class="form-label">Job Title</label>
                                <input type="text" name="job_title" id="emp_num" class="form-control {{ $errors->has('job_title') ? ' is-invalid' : '' }}" value="{{ old('job_title',$user->job_title) }}">
                                @error('job_title')
                                     <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" name="address" id="address" class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}" value="{{ old('address',$user->address) }}">
                                @error('address')
                                     <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="address" class="form-label">Gender</label>
                                <select id="address" class="custom-select {{ $errors->has('address') ? ' is-invalid' : '' }}" name="gender">
                                    <option value="">Choose Gender</option>
                                    <option value="male" {{ old('gender',$user->gender) == 'male' ? 'selected':''}}>Male</option>
                                    <option value="female" {{ old('gender',$user->gender) =='female' ? 'selected':''}}>Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="mobile_number" class="form-label">Mobile Number</label>
                                <input type="text" name="mobile_number" id="address" class="form-control {{ $errors->has('mobile_number') ? ' is-invalid' : '' }}" value="{{ old('mobile_number',$user->mobile_number) }}">
                                @error('mobile_number')
                                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="office_number" class="form-label">Office Number</label>
                                <input type="text" name="office_number" id="office_number" class="form-control {{ $errors->has('office_number') ? ' is-invalid' : '' }}" value="{{ old('office_number',$user->office_number) }}">
                                @error('office_number')
                                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="supervisor_email" class="form-label">Supervisor Email</label>
                                <input type="text" name="supervisor_email" id="supervisor_email" class="form-control {{ $errors->has('supervisor_email') ? ' is-invalid' : '' }}" value="{{ old('supervisor_email',$user->supervisor_email) }}">
                                @error('supervisor_email')
                                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="location" class="form-label">Location</label>
                                <select class="custom-select {{ $errors->has('location') ? ' is-invalid' : '' }}" name="location">
                                    <option value="">Choose Location</option>
                                    @foreach(\App\Location::all() as $location)
                                        <option value="{{ $location->id }}" {{old( 'location' , $user->location_id ) == $location->id ? 'selected':''}}>{{$location->location_name}}</option>
                                    @endforeach
                                </select>
                                @error('location')
                                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-outline-success">Update Profile</button>
                </div>
            </form>
        </div>
    </div>


@endsection
