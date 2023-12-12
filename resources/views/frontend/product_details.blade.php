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
                       {{ Breadcrumbs::render('product.details') }}
                    </ol>
                </div>
            </div>
        </div> <!-- end row -->
    </div> <!-- end container -->
</section>
<!-- end page-title -->

<!-- product-single-section  start-->
<div class="product-single-section section-padding">
    <div class="container">
        <div class="product-details">
            <div class="row align-items-center">
                <div class="col-lg-5">

                    <div class="product-single-img">
                        <div class="product-active owl-carousel">
                            @foreach ($thumbnails as $thumbnail)
                            <div class="item">
                                <img src="{{asset('uploads/product/thumbnail')}}/{{$thumbnail->thumbnail }}" alt="">
                            </div>
                            @endforeach
                        </div>
                        <div class="product-thumbnil-active  owl-carousel">
                            @foreach ($thumbnails as $thumbnail)
                            <div class="item">
                                <img src="{{asset('uploads/product/thumbnail')}}/{{$thumbnail->thumbnail }}" alt="">
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <form action="{{ route('cart.store') }}" method="POST">
                    @csrf
                     <input class="text-value" name="product_id" type="hidden" value="{{$product_details->id}}">
                    <div class="product-single-content">
                        <h2>{{$product_details->product_name}}</h2>
                        <div class="price">
                            <span class="present-price">&#2547; {{$product_details->after_discount}}</span>
                            <del class="old-price">&#2547; {{$product_details->price}}</del>
                        </div>
                        @php
                            $total_review = $product_reviews->count();
                            $avg='';
                            if($total_review != 0){
                                $avg = round($total_star / $total_review);
                            }
                            else {
                                $avg = 0;
                            }
                        @endphp
                        <div class="rating-product">
                            @for($i=1; $i<=$avg; $i++)
                               <i class="fa fa-star"></i>
                            @endfor
                            @for ($i<=$avg; $i<=5; $i++)
                            <i class="fa fa-star-o"></i>
                            @endfor
                            {{-- @if ($total_star % 2 != 0 )
                               <i class="fa fa-star-half-o"></i>
                            @endif --}}
                            <span>{{ $product_reviews->count() }} Reviews</span>
                        </div>
                        <p>{{$product_details->short_desp}}
                        </p>
                        <div class="product-filter-item color">
                            <div class="color-name">
                                <span>Color :</span>
                                <ul>
                                    @foreach ($available_colors as $color)
                                    @if ($color->rel_to_color->color_name == 'NA')
                                    <li title="{{$color->rel_to_color->color_name}}"><input class="color_id" checked id="color{{$color->color_id}}" type="radio" name="color_id" value="{{$color->color_id}}">
                                        <label style="background: transparent; border:2px solid #000;text-align:center;line-height:40px; width:40px; height:40px;" for="color{{$color->color_id}}">{{$color->rel_to_color->color_name}}</label>
                                    </li>
                                    @else
                                    <li title="{{$color->rel_to_color->color_name}}">
                                        <input class="color_id" id="color{{$color->color_id}}" type="radio" name="color_id" value="{{$color->color_id}}">
                                        <label for="color{{$color->color_id}}" style="background: {{$color->rel_to_color->color_code}}"></label>
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="product-filter-item color filter-size">
                            <div class="color-name">
                                <span>Sizes:</span>
                                <ul class="size_loca">
                                    @foreach ($available_sizes as $size)
                                    @if ($size->rel_to_size->size_name == 'NA')
                                    <li class="color"><input checked id="size{{$size->size_id}}" type="radio" name="size_id" value="{{$size->size_id}}">
                                        <label for="size{{$size->size_id}}">{{$size->rel_to_size->size_name}}</label>
                                    </li>
                                    @else
                                    <li class="color"><input class="size_id" id="size{{$size->size_id}}" type="radio" name="size_id" value="{{$size->size_id}}">
                                        <label style="font-size: 15px" for="size{{$size->size_id}}">{{$size->rel_to_size->size_name}}</label>
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="pro-single-btn">
                            <div class="quantity cart-plus-minus">
                                <input class="text-value" name="quantity" type="text" value="1">
                            </div>
                            @auth('customer')
                            <button type="submit" class="theme-btn-s2">Add to cart</button>
                            @else
                            <a href="{{ route('customer.login') }}" class="theme-btn-s2">Add to cart</a>
                            @endauth

                            <a href="#" class="wl-btn"><i class="fi flaticon-heart"></i></a>
                        </div>
                        <ul class="important-text">
                            <li><span>SKU:</span> {{$product_details->sku}}</li>
                            <li><span>Categories:</span> {{$product_details->rel_to_cat->category_name}}</li>
                            <li><span>Tags:</span>
                                @php
                                    $aa = explode(',', $product_details->tags);
                                @endphp
                                @foreach ($aa as $a)
                                   <a href="" class="text-dark" style="background: #ddd; padding:5px 10px">{{ App\Models\Tag::where('id', $a)->first()->tag_name }}</a>
                                @endforeach
                            </li>
                            <li><span>Stock:</span> <span id="stock"></span> Items In Stock <strong class="text-danger">{{ session('stockout')?session('stockout'):'' }}</strong></li>

                            @if (session('stockout'))
                                <div class="alert alert-warning">Out of Stock</div>
                            @endif
                        </ul>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="product-tab-area">
            <ul class="nav nav-mb-3 main-tab" id="tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="descripton-tab" data-bs-toggle="pill"
                        data-bs-target="#descripton" type="button" role="tab" aria-controls="descripton"
                        aria-selected="true">Description</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="Ratings-tab" data-bs-toggle="pill" data-bs-target="#Ratings"
                        type="button" role="tab" aria-controls="Ratings" aria-selected="false">Reviews
                        (3)</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="Information-tab" data-bs-toggle="pill"
                        data-bs-target="#Information" type="button" role="tab" aria-controls="Information"
                        aria-selected="false">Additional info</button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="descripton" role="tabpanel"
                    aria-labelledby="descripton-tab">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="Descriptions-item">
                                    {!!$product_details->long_desp!!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="Ratings" role="tabpanel" aria-labelledby="Ratings-tab">
                    <div class="container">
                        <div class="rating-section">
                            <div class="row">
                                <div class="col-lg-12 col-12">
                                    <div class="comments-area">
                                        <div class="comments-section">
                                            <h3 class="comments-title">{{ $total_review }} reviews for {{ $product_details->product_name }}</h3>
                                            <ol class="comments">
                                                @foreach ($product_reviews as $product_review)
                                                <li class="comment even thread-even depth-1" id="comment-1">
                                                    <div id="div-comment-1">
                                                        <div class="comment-theme">
                                                            <div class="comment-image">
                                                                @if ($product_review->rel_to_customer->photo == null)
                                                                    <img width="100" src="{{ Avatar::create($product_review->rel_to_customer->name)->toBase64() }}" />
                                                                @else
                                                                    <img class="rounded-circle" width="35" src="{{ asset('uploads/customer') }}/{{ $product_review->rel_to_customer->photo }}" alt="">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="comment-main-area">
                                                            <div class="comment-wrapper">
                                                                <div class="comments-meta">
                                                                    <h4>{{ $product_review->rel_to_customer->name }}</h4>
                                                                    <span class="comments-date">{{ $product_review->rel_to_customer->updated_at }}</span>
                                                                    <div class="rating-product">
                                                                        @for ($i=1; $i<=$product_review->star; $i++)
                                                                        <i class="fi flaticon-star"></i>
                                                                        @endfor
                                                                    </div>
                                                                </div>
                                                                <div class="comment-area">
                                                                    <p>
                                                                        {{ $product_review->review }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ol>
                                        </div> <!-- end comments-section -->
                                        @auth('customer')
                                        @if (App\Models\OrderProduct::where('customer_id', Auth::guard('customer')->id())->where('product_id', $product_details->id)->exists())
                                        @if (App\Models\OrderProduct::where('customer_id', Auth::guard('customer')->id())->where('product_id', $product_details->id)->whereNotNull('review')->first() == false)
                                        <div class="col col-lg-10 col-12 review-form-wrapper">
                                            <div class="review-form">
                                                <h4>Add a review</h4>
                                                <form action="{{ route('review.store') }}" method="POST">
                                                    @csrf
                                                    <div class="give-rat-sec">
                                                        <div class="give-rating">
                                                            <label>
                                                                <input type="radio" name="stars" value="1">
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="stars" value="2">
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="stars" value="3">
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="stars" value="4">
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="stars" value="5">
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <textarea name="review" class="form-control"
                                                            placeholder="Write Comment..."></textarea>
                                                    </div>
                                                    <div class="name-input">
                                                        <input value="{{ Auth::guard('customer')->user()->name }}" type="text" class="form-control" placeholder="Name"
                                                            disabled>
                                                    </div>
                                                    <div class="name-email">
                                                        <input value="{{ Auth::guard('customer')->user()->email }}" type="email" class="form-control" placeholder="Email"
                                                            disabled>
                                                    </div>
                                                    <div class="name-email">
                                                        <input value="{{ Auth::guard('customer')->id() }}" type="hidden" class="form-control" name="customer_id">
                                                        <input value="{{ $product_details->id }}" type="hidden" class="form-control" name="product_id">
                                                    </div>
                                                    <div class="rating-wrapper">
                                                        <div class="submit">
                                                            <button type="submit" class="theme-btn-s2">Post
                                                                review</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        @else
                                        <div class="alert alert-info d-flex justify-content-between">
                                            <h4>You already reviewed this product </h4>
                                        </div>
                                        @endif
                                        @else
                                        <div class="alert alert-info d-flex justify-content-between">
                                            <h4>You did not purchase this product yet </h4>
                                        </div>
                                        @endif
                                        @else
                                        <div class="alert alert-info d-flex justify-content-between">
                                            <h4>Please login to submit review </h4>
                                            <a class="btn btn-primary" href="{{ route('customer.login') }}">Login</a>
                                        </div>
                                        @endauth
                                    </div> <!-- end comments-area -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="Information" role="tabpanel" aria-labelledby="Information-tab">
                    <div class="container">
                        <div class="Additional-wrap">
                            <div class="row">
                                <div class="col-12">
                                    <div>
                                        {!!$product_details->additional_info!!}
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
<!-- product-single-section  end-->

<!-- start of themart-trendingproduct-section -->
<section class="themart-trendingproduct-section section-padding pt-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="wpo-section-title">
                    <h2>Related Product</h2>
                </div>
            </div>
        </div>
        <div class="{{($related_products->count() >= 4?'trendin-slider owl-carousel':'row')}}">
            @forelse ($related_products as $related)
            <div class="{{($related_products->count() <= 4?'col-lg-4':'')}}">
                <div class="product-item">
                    <div class="image">
                        <img src="{{asset('uploads/product/preview')}}/{{$related->preview}}" alt="">
                        <div class="tag new">New</div>
                    </div>
                    <div class="text">
                        <h2><a href="product-single.html">Pink Baby Shoes</a></h2>
                        <div class="rating-product">
                            <i class="fi flaticon-star"></i>
                            <i class="fi flaticon-star"></i>
                            <i class="fi flaticon-star"></i>
                            <i class="fi flaticon-star"></i>
                            <i class="fi flaticon-star"></i>
                            <span>130</span>
                        </div>
                        <div class="price">
                            <span class="present-price">$120.00</span>
                            <del class="old-price">$200.00</del>
                        </div>
                        <div class="shop-btn">
                            <a class="theme-btn-s2" href="product.html">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-center">No Related Product Found</p>
            @endforelse
        </div>
    </div>
</section>
<!-- end of themart-trendingproduct-section -->
@endsection
@section('footer_script')
<script>
    $('.color_id').click(function (){
        var color_id = $(this).val();
        var product_id = '{{ $product_details->id }}';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'POST',
            url:'/getSize',
            data:{'color_id': color_id, 'product_id':product_id},
            success:function(data){
                $('.size_loca').html(data);
                    $('.size_id').click(function (){
                    var size_id = $(this).val();
                    var color_id = $('input[class="color_id"]:checked').val();
                    var product_id = '{{ $product_details->id }}';
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type:'POST',
                        url:'/getStock',
                        data:{'color_id': color_id, 'product_id':product_id, 'size_id':size_id},
                        success:function(data){
                        $('#stock').html(data);
                        }
                    });
                })
            }
        });
    })
</script>

@if (session('cart_added'))
    <script>
        Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Your work has been saved',
        showConfirmButton: false,
        timer: 1500
        })
    </script>
@endif
@if (session('review'))
    <script>
        Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: '{{ session('review') }}',
        showConfirmButton: false,
        timer: 1500
        })
    </script>
@endif
@endsection
