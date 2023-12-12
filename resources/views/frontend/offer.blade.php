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
                        <li>New Year Offer</li>
                    </ol>
                </div>
            </div>
        </div> <!-- end row -->
    </div> <!-- end container -->
</section>
<!-- end page-title -->
<div class="container my-5">
    <div class="product-wrap">
        <div class="row">
            @foreach ($newyear_products as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <div class="product-item">
                    <a href="{{route('product.details', $product->slug)}}">
                        <div class="image">
                            <img src="{{asset('uploads/product/preview')}}/{{$product->preview}}" alt="">
                            @if ($product->discount)
                            <div class="tag sale">-{{$product->discount}}%</div>
                            @else
                            <div class="tag new">New</div>
                            @endif
                        </div>
                    </a>
                    @php

                        $total_review = App\Models\OrderProduct::where('product_id',$product->id)->whereNotNull('review')->count();
                        $total_star = App\Models\OrderProduct::where('product_id', $product->id)->whereNotNull('review')->sum('star');
                        $avg='';
                        if($total_review != 0){
                            $avg = round($total_star / $total_review);
                        }
                        else {
                            $avg = 0;
                        }
                    @endphp
                    <div class="text">
                        <h2><a href="product-single.html">
                        @if (strlen($product->product_name) > 25)
                            {{substr($product->product_name, 0, 25).'...'}}
                        @else
                            {{$product->product_name}}
                        @endif
                        </a></h2>
                        <div class="rating-product">
                        @for($i=1; $i<=$avg; $i++)
                            <i class="fa fa-star"></i>
                        @endfor
                        @for ($i<=$avg; $i<=5; $i++)
                        <i class="fa fa-star-o"></i>
                        @endfor
                        <span>{{ $total_review }} Reviews</span>
                        </div>
                        <div class="price">
                            <span class="present-price">&#2547; {{$product->after_discount}}</span>
                            @if ($product->discount)
                            <del class="old-price">&#2547; {{$product->price}}</del>
                            @endif
                        </div>
                        <div class="shop-btn">
                            <a class="theme-btn-s2" href="product.html">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        {{ $newyear_products->links() }}
    </div>
</div>
@endsection
