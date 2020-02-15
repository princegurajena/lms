@extends('layouts.auth',['title'=>"Password Change",'active'=>''])
@section('content')
    <div class="row">
        <div class="col col-login mx-auto">
            <div class="text-center mb-6">
                <h4><img src="{{url('images/logo.png')}}" class="h-6" alt="">Agribank Leave Management</h4>
            </div>
            <form class="card" method="POST" action="/new_users_password_change_update/{{auth()->user()->id}}">
                @csrf
                <div class="card-body p-6">
                    @if(session('message'))
                        <div class="alert alert-danger alert-dismissible">{{session('message')}}</div>
                    @endif
                    <div class="card-title">Update Password</div>

                    <div class="form-group">
                        <label class="form-label">Current Password</label>
                        <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password"  autocomplete="current-password" placeholder="Password">
                        @error('current_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Enter New Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="password" placeholder="New Password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Confirm New Password</label>
                        <input  id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="password_confirmation" placeholder="Confirm New Password">

                    </div>

                    <div class="form-footer">
                        <button type="submit" class="btn btn-outline-success btn-block">Log In</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection