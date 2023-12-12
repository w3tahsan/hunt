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
                        <li><a href="cart.html">Cart</a></li>
                        <li>Checkout</li>
                    </ol>
                </div>
            </div>
        </div> <!-- end row -->
    </div> <!-- end container -->
</section>
<!-- end page-title -->

<!-- wpo-checkout-area start-->
<div class="wpo-checkout-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="single-page-title">
                    <h2>Your Checkout</h2>
                    <p>There are 4 products in this list</p>
                </div>
            </div>
        </div>
        @if (session('order_success'))
            <div class="alert alert-success">{{ session('order_success') }}</div>
        @endif
        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <div class="checkout-wrap">
                <div class="row">
                    <div class="col-lg-7 col-12">
                        <div class="caupon-wrap s3">
                            <div class="biling-item">
                                <div class="coupon coupon-3">
                                    <h2>Billing Address</h2>
                                </div>
                                <div class="billing-adress">
                                    <div class="contact-form form-style">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-12 col-12">
                                                <input type="text" placeholder="First Name*" id="fname1"
                                                    name="fname" value="{{ Auth::guard('customer')->user()->name }}">
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-12">
                                                <input type="text" placeholder="Last Name*" id="fname2"
                                                    name="lname">
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-12">
                                                <input type="email" placeholder="Email Address*" id="email4"
                                                    name="email" value="{{ Auth::guard('customer')->user()->email }}">
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-12">
                                                <input type="number" placeholder="Phone*" id="phone"
                                                    name="phone">
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-12">
                                                <select name="country_id" class="form-control country">
                                                    <option value="">Country*</option>
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->id}}">{{ $country->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-12">
                                                <select name="city_id" class="form-control city">
                                                    <option value="">Select City</option>
                                                </select>
                                            </div>

                                            <div class="col-lg-12 col-md-12 col-12">
                                                <input type="text" placeholder="Address*" id="Adress"
                                                    name="address">
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-12">
                                                <input type="text" placeholder="Postcode / ZIP*" id="Post2"
                                                    name="zip">
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-12">
                                                <input type="text" placeholder="Company Name*" id="Company"
                                                    name="company">
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-12">
                                                <div class="note-area">
                                                    <textarea name="notes"
                                                        placeholder="Additional Information"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="biling-item-3">
                                    <input id="toggle4" type="checkbox" name="ship_check" value="1">
                                    <label class="fontsize" for="toggle4">Ship to a Different Address?</label>
                                    <div class="billing-adress" id="open4">
                                        <div class="contact-form form-style">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-12 col-12">
                                                    <input type="text" placeholder="First Name*" id="fname6"
                                                        name="ship_fname">
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-12">
                                                    <input type="text" placeholder="Last Name*" id="fname7"
                                                        name="ship_lname">
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-12">
                                                    <input type="text" placeholder="Email Address*" id="email5"
                                                        name="ship_email">
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-12">
                                                    <input type="text" placeholder="Phone*" id="phone1"
                                                        name="ship_phone">
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-12">
                                                    <select name="ship_country_id" class="form-control country2">
                                                        <option disabled="" >Country*</option>
                                                        @foreach ($countries as $country)
                                                            <option value="{{ $country->id}}">{{ $country->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                               <div class="col-lg-6 col-md-12 col-12">
                                                    <select name="ship_city_id" class="form-control city2">
                                                        <option value="">Select City*</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-12">
                                                    <input type="text" placeholder="Address*" id="Adress1"
                                                        name="ship_address">
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-12">
                                                    <input type="text" placeholder="Postcode / ZIP*" id="Post1"
                                                        name="ship_zip">
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-12">
                                                    <input type="text" placeholder="Company Name*" id="Company1"
                                                        name="ship_company">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-12">
                        <div class="cout-order-area">
                            <h3>Your Order</h3>
                            <div class="oreder-item">
                                <div class="title">
                                    <h2>Products <span>Subtotal</span></h2>
                                </div>
                                @php
                                    $pre_total = 0;
                                @endphp
                                @foreach ($carts as $cart)
                                <div class="oreder-product">
                                    <div class="images">
                                        <span>
                                            <img src="{{ asset('uploads/product/preview') }}/{{ $cart->rel_to_product->preview }}" alt="">
                                        </span>
                                    </div>
                                    <div class="product">
                                        <ul>
                                            <li class="first-cart"> {{ substr($cart->rel_to_product->product_name,0,18 ).'...' }}(x{{ $cart->quantity }})</li>
                                            <li>
                                                <div class="rating-product ">
                                                    <i class="fi flaticon-star"></i>
                                                    <i class="fi flaticon-star"></i>
                                                    <i class="fi flaticon-star"></i>
                                                    <i class="fi flaticon-star"></i>
                                                    <i class="fi flaticon-star"></i>
                                                    <span>15</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <span>&#2547; {{ $cart->rel_to_product->after_discount*$cart->quantity }}</span>
                                </div>
                                @php
                                    $pre_total += $cart->rel_to_product->after_discount*$cart->quantity;
                                @endphp
                                @endforeach
                                <!-- Shipping -->
                                <div class="mt-3 mb-3">
                                    <div class="title border-0">
                                        <h2>Delivery Charge</h2>
                                    </div>
                                    <ul>
                                        <li class="free">
                                            <input data-total="{{ $pre_total - session('discount') }}" class="delivery" id="Free" type="radio" name="delivery" value="1">
                                            <label for="Free">Inside City: <span>&#2547; {{ $inside_charge }}</span></label>
                                        </li>
                                        <li class="free">
                                            <input data-total="{{ $pre_total - session('discount') }}" class="delivery" id="Local" type="radio" name="delivery" value="2">
                                            <label for="Local">Outside City: <span>&#2547; {{ $outside_charge }}</span></label>
                                        </li>
                                    </ul>
                                </div>
                                <div>
                                    <p class="d-flex justify-content-between"><span>Discount:</span> <span>&#2547; {{ session('discount')?session('discount'):'00' }}</span></p>
                                </div>
                                <div class="title s2">
                                    <h2>Total<span>&#2547; <span id="final_total">{{ $pre_total - session('discount') }}</span></span> </h2>
                                </div>
                            </div>
                        </div>
                        <div class="caupon-wrap s5">
                            <div class="payment-area">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="payment-option" id="open5">
                                            <h3>Payment</h3>
                                            <div class="payment-select">
                                                <ul>
                                                    <li class="">
                                                        <input id="remove" type="radio" name="payment_method"
                                                            value="1">
                                                        <label for="remove">Cash on Delivery</label>
                                                    </li>
                                                    <li class="">
                                                        <input id="add" type="radio" name="payment_method" checked="checked" value="2">
                                                        <label for="add">Pay With SSLCOMMERZ</label>
                                                    </li>
                                                    <li class="">
                                                        <input id="getway" type="radio" name="payment_method"
                                                            value="3">
                                                        <label for="getway">Pay With STRIPE</label>
                                                    </li>
                                                </ul>
                                            </div>
                                            <input type="hidden" name="sub_total" value="{{ $pre_total }}">
                                            <input type="hidden" name="discount" value="{{ session('discount') }}">
                                            <input type="hidden" name="customer_id" value="{{ Auth::guard('customer')->id() }}">
                                            <div id="open6" class="payment-name active">
                                                <div class="contact-form form-style">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-12">
                                                            <div class="submit-btn-area text-center">
                                                                <button class="theme-btn" type="submit">Place
                                                                    Order</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- wpo-checkout-area end-->
@endsection
@section('footer_script')
<script>
    $('.delivery').click(function(){
        var inside = {{ $inside_charge }};
        var outside = {{ $outside_charge }};
        var delivery = $(this).val();
        var total = $(this).attr('data-total');
        var final_total = 0;
        if(delivery == 1){
            final_total = parseInt(total)+inside;
        }
        else{
            final_total = parseInt(total)+outside;
        }

        $('#final_total').html(final_total);
    })
</script>
<script>
    $('.country').change(function(){
        var country_id = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'POST',
            url:'/getCity',
            data:{'country_id': country_id},
            success:function(data){
                $('.city').html(data);
            }
        });
    });
    $('.country2').change(function(){
        var country_id = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:'POST',
            url:'/getCity',
            data:{'country_id': country_id},
            success:function(data){
                $('.city2').html(data);
            }
        });
    });
</script>
@endsection

