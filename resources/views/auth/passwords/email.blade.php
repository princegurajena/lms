@extends('layouts.auth',['title'=>"Password Reset",'active'=>''])
@section('content')
    <div class="row">
        <div class="col col-login mx-auto">
            <div class="text-center mb-6">
                <h4><img src="{{url('images/logo.png')}}" class="h-6" alt="">Agribank Leave Management</h4>
            </div>
            <form class="card" method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="card-body p-6">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="card-title">Forgot password</div>
                    <p class="text-muted">Enter your email address and your password will be reset and emailed to you.</p>
                    <div class="form-group">
                        <label class="form-label" for="exampleInputEmail1">Email address</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-outline-success btn-block">Send me new password</button>
                    </div>
                </div>
            </form>
            <div class="text-center text-muted">
                Forget it, <a href="/home" class="text-success">send me back</a> to the sign in screen.
            </div>
        </div>
    </div>
@endsection
