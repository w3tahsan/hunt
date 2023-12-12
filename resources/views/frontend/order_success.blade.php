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
                        <li>Order Success</li>
                    </ol>
                </div>
            </div>
        </div> <!-- end row -->
    </div> <!-- end container -->
</section>
<!-- end page-title -->

<!-- start error-404-section -->
<section class="error-404-section section-padding">
    <div class="container">
        <div class="row">
            <div class="col col-xs-12">
                <div class="content clearfix">
                    <div class="error">
                        <img width="600" src="{{ asset('front/images/success.jpg') }}" alt>
                    </div>
                    <div class="error-message">
                        <h3>Congratulations!!</h3>
                        <p>{{session('order_success')}}</p>
                        <a href="{{ route('index') }}" class="theme-btn">Back to home</a>
                    </div>
                </div>
            </div>
        </div> <!-- end row -->
    </div> <!-- end container -->
</section>
<!-- end error-404-section -->
@endsection
