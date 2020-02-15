@extends('layouts.main',['title'=>'','active'=>''])

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-9 text-center">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit User Information</h3>
                </div>

                <div class="">
                    @if(session()->has('message'))
                        <div class="alert alert-success rounded-0 text-center">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                </div>

                <div class="card-body">
                    <form action="/users/{{$user->id}}/view" method="post">
                        @csrf
                        <div class="form-label">Leave Balances</div>

                        <div class="row">
                            <div class="co-lg-12 px-5">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="">Sick Leave</label>
                                                <input type="number" class="form-control" id="bal1" name="sick_leave"
                                                       value="{{ old('sick_leave',$user->sick_leave) }}" required></td>
                                                @error('sick_leave')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="">Study Leave</label>
                                                <input type="number" class="form-control" id="bal1" name="study_leave"
                                                       value="{{ old('study_leave',$user->study_leave) }}"
                                                       required></td>
                                                @error('study_leave')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="">Sick Leave Full Pay</label>
                                                <input type="number" class="form-control" id="bal2"
                                                       name="sick_leave_full_pay"
                                                       value="{{ old('sick_leave_full_pay',$user->sick_leave_full_pay) }}"
                                                       required></td>
                                                @error('sick_leave_full_pay')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="">Sick Leave Half Pay</label>
                                                <input type="number" class="form-control" id="bal3"
                                                       name="sick_leave_half_pay"
                                                       value="{{ old('sick_leave_half_pay',$user->sick_leave_half_pay) }}"
                                                       required></td>
                                                @error('sick_leave_half_pay')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="">Maternity Leave</label>
                                                <input type="number" class="form-control" id="bal5"
                                                       name="maternity_leave"
                                                       value="{{ old('maternity_leave',$user->maternity_leave) }}"
                                                       required>
                                                @error('maternity')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="">Annual Leave</label>
                                                <input type="number" class="form-control" id="bal6" name="annual_leave"
                                                       value="{{ old('annual_leave',$user->annual_leave) }}" required>
                                                @error('annual')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer text-right">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>

@endsection

