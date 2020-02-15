@extends('layouts.main',['title'=>"Verify Email",'active'=>''])

@section('content')
    <div class="row">
        <div class="col col-5 mx-auto">

            <div class="card" >
                <a href="#"><img class="card-img-top" src="{{url('images/welcome.jpg')}}" alt="And this isn&#39;t my nose. This is a false one."></a>
                <div class="card-body d-flex flex-column">
                    <h4><a href="#">Welcome to the Agribank Leave Management System </a></h4>
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            A fresh verification link has been sent to your email address {{auth()->user()->email}}
                        </div>
                    @endif
                    <div class="text-muted">Before proceeding, please check your email for a verification link , If you did not receive the email, <a href="{{ route('verification.resend') }}" class="text-success"><i class="fa fa-hand-o-up"></i> click here</a> to request another</div>

                    <div class="d-flex align-items-center pt-5 mt-auto">
                        <div class="avatar avatar-md mr-3" style="background-image: url( '{{ asset('images/logo.png')}}')"></div>
                        <div>
                            <a href="http://www.agribank.co.zw/" class="text-default">Agricultural Bank of Zimbabwe</a>
                            <small class="d-block text-muted">This portal was designed by <a href="https://www.facebook.com/ronaldnayasha.kanyepi" class="text-default">Ronald N Kanyepi</a>. ICT-Echannels</small>
                        </div>
                        <div class="ml-auto text-muted">
                            <a href="javascript:void(0)" class="icon d-none d-md-inline-block ml-3"><i class="fe fe-heart mr-1"></i></a>
                        </div>
                    </div>

            </div>
        </div>
    </div>
@endsection
