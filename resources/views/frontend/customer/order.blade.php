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
                        <li>Customer Order</li>
                    </ol>
                </div>
            </div>
        </div> <!-- end row -->
    </div> <!-- end container -->
</section>
<!-- end page-title -->
<div class="container">
    <div class="row my-5">
    <div class="col-lg-3">
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
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h3>My Orders</h3>
            </div>
            <div class="card-body">
                <!-- cart-area start -->
                <div class="order-area section-padding pt-0">
                    <div class="container">
                        <div class="form">
                            <div class="order-wrapper">
                                <div class="row">
                                    <div class="col-12">
                                        <form action="https://wpocean.com/html/tf/themart/order">
                                            <table class="table-responsive order-wrap">
                                                <thead>
                                                    <tr>
                                                        <th class="images images-b">Order ID</th>
                                                        <th class="product">Date</th>
                                                        <th class="">Total Price</th>
                                                        <th class="remove">Status</th>
                                                        <th class="action remove-b">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($orders as $order)
                                                    <tr>
                                                        <td class="images">{{ $order->order_id }}</td>
                                                        <td class="product">{{ $order->created_at->format('d-M-Y') }}</td>
                                                        <td class="">&#2547; {{ $order->total }}</td>
                                                        <td class="Del">
                                                            @if ($order->status == 0)
                                                                <button class="btn btn-secondary">Placed</button>
                                                                @elseif ($order->status == 1)
                                                                <button class="btn btn-info">Processing</button>
                                                                @elseif ($order->status == 2)
                                                                <button class="btn btn-primary">Shipped</button>
                                                                @elseif ($order->status == 3)
                                                                <button class="btn btn-warning">Ready To Deliver</button>
                                                                @elseif ($order->status == 4)
                                                                <button class="btn btn-success">Delivered</button>
                                                                @else
                                                                    <button class="btn btn-danger">Cancel</button>
                                                            @endif
                                                        </td>
                                                        <td class="action">
                                                            <ul>
                                                                <li class="w-btn-view">
                                                                    <a title="Download Invoice" href="{{ route('download.invoice', $order->id) }}"><i class="fa fa-download"></i></a>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- order-area end -->
            </div>
        </div>
    </div>
</div>
</div>
@endsection
