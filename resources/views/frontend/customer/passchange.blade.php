@extends('frontend.master')
@section('content')
 <!-- start wpo-page-title -->
<section class="wpo-page-title">
    <h2 class="d-none">Hide</h2>
    <div class="container">
        <div class="row">
            <div class="col col-xs-12">
                <div class="wpo-breadcumb-wrap">
                    <ol class="wpo-breadcumb-wrap">
                        <li><a href="index.html">Home</a></li>
                        <li>Customer Password Change</li>
                    </ol>
                </div>
            </div>
        </div> <!-- end row -->
    </div> <!-- end container -->
</section>
<!-- end page-title -->
<div class="container">
    <div class="row my-5">
    <div class="col-lg-4">
        <div class="card" style="width: 18rem;">
        <div class="card-header">
            <div class="text-center">
                @if (Auth::guard('customer')->user()->photo == null)
                    <img width="70" src="{{ Avatar::create(Auth::guard('customer')->user()->name)->toBase64() }}" />
                @else
                    <img width="70" src="{{ asset('uploads/customer') }}/{{ Auth::guard('customer')->user()->photo }}" class="img-fluid rounded-circle" alt="">
                @endif
                <h3 class="pt-2">{{ Auth::guard('customer')->user()->name }}</h3>
            </div>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item bg-light py-3"><a class="text-dark" href="{{ route('customer.prtofile') }}">Profile</a></li>
            <li class="list-group-item bg-light py-3"><a class="text-dark" href="{{ route('customer.password.change') }}">Change Password</a></li>
            <li class="list-group-item bg-light py-3"><a class="text-dark" href="{{ route('customer.order') }}">My Order</a></li>
            <li class="list-group-item bg-light py-3"><a class="text-dark" href="">Wishlist</a></li>
            <li class="list-group-item bg-light py-3"><a class="text-dark" href="">Logout</a></li>
        </ul>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>Change Password</h3>
            </div>
            <div class="card-body">
                @if (session('updated'))
                    <div class="alert alert-success">{{ session('updated') }}</div>
                @endif
                @if (session('wrong'))
                    <div class="alert alert-danger">{{ session('wrong') }}</div>
                @endif
                <form action="{{ route('customer.pass.update') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="" class="form-label">Current Password</label>
                                <input type="password" name="current_password" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="" class="form-label">New Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="" class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" >
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="mb-3 text-center">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
