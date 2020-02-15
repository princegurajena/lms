@extends('layouts.auth',['title'=>"Login",'active'=>''])
@section('content')
    <div class="row">
        <div class="col col-login mx-auto">
            <div class="text-center mb-6">
                <h4><img src="{{url('images/logo.png')}}" class="h-6" alt="">Agribank Leave Management</h4>
            </div>
            <form class="card" method="POST" action="{{ route('login') }}">
             @csrf

                <div class="card-body p-6">
                    <div class="card-title">Login to your account</div>
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
                        <label class="form-label">
                            Password
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="float-right small text-success">I forgot password</a>
                            @endif
                        </label>

                         <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}/>
                            <span class="custom-control-label">Remember me</span>
                        </label>
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-outline-success btn-block">Sign in</button>
                    </div>
                </div>
            </form>
            <div class="text-center text-muted">
                Don't have account yet? <a href="/" class="text-success">Sign up</a>
            </div>
        </div>
    </div>
@endsection