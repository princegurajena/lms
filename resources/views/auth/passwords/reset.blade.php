@extends('layouts.auth',['title'=>"Reset Password",'active'=>''])
@section('content')
    <div class="row">
        <div class="col col-login mx-auto">
            <div class="text-center mb-6">
                <h4><img src="{{url('images/logo.png')}}" class="h-6" alt="">Agribank Leave Management</h4>
            </div>
            <form class="card" method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="card-body p-6">
                    <div class="card-title">Reset Password</div>
                    <div class="form-group">
                        <label class="form-label">Email address</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus aria-describedby="emailHelp" placeholder="Enter email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Confirm Password</label>
                        <input  id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                    </div>

                    <div class="form-footer">
                        <button type="submit" class="btn btn-outline-success btn-block">Update Password</button>
                    </div>
                </div>
            </form>
            <div class="text-center text-muted">
                Go back to Log in Screen <a href="/login" class="text-success">Login</a>
            </div>
        </div>
    </div>
@endsection
