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
                        <li>Shop</li>
                    </ol>
                </div>
            </div>
        </div> <!-- end row -->
    </div> <!-- end container -->
</section>
<!-- end page-title -->

<!-- product-area-start -->
<div class="shop-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="shop-filter-wrap">
                    <div class="filter-item">
                        <div class="shop-filter-item">
                            <div class="shop-filter-search">
                                <form>
                                    <div>
                                        <input type="text" class="form-control search_input" placeholder="Search.." value="{{ @$_GET['q'] }}">
                                        <button type="button" class="search_btn"><i class="ti-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="filter-item">
                        <div class="shop-filter-item">
                            <h2>Category</h2>
                            <ul>
                                @foreach ($categories as $category)
                                <li>
                                    <label class="topcoat-radio-button__label">
                                        {{ $category->category_name }} <span>({{ App\Models\Product::where('category_id', $category->id)->count() }})</span>
                                        <input class="category_id" {{ $category->id == @$_GET['category_id']?'checked':'' }} type="radio" name="category_id" value="{{ $category->id }}">
                                        <span class="topcoat-radio-button"></span>
                                    </label>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="filter-item">
                        <div class="shop-filter-item">
                            <h2>Filter by price</h2>
                            <div class="shopWidgetWraper">
                                <div class="priceFilterSlider">

                                        <div class="d-flex">
                                            <div class="col-lg-6 pe-2">
                                                <label for="" class="form-label">Min</label>
                                                <input type="text" class="form-control min" placeholder="Min" value="{{ @$_GET['min'] }}">
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="" class="form-label">Max</label>
                                                <input type="text" class="form-control max" placeholder="Max" value="{{ @$_GET['max'] }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mt-4">
                                            <button id="range" class="form-control bg-light">Submit</button>
                                        </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="filter-item">
                        <div class="shop-filter-item">
                            <h2>Color</h2>
                            <ul>
                                @foreach ($colors as $color)
                                <li>
                                    <label class="topcoat-radio-button__label">
                                        {{ $color->color_name }} <span>({{ App\Models\Inventory::where('color_id', $color->id)->count() }})</span>
                                        <input {{ $color->id == @$_GET['color_id']?'checked':'' }} class="color_id" type="radio" name="color_id" value="{{ $color->id }}">
                                        <span class="topcoat-radio-button"></span>
                                    </label>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="filter-item">
                        <div class="shop-filter-item">
                            <h2>Size</h2>
                            <ul>
                                @foreach ($sizes as $size)
                                <li>
                                    <label class="topcoat-radio-button__label">
                                        {{ $size->size_name }} <span>({{ App\Models\Inventory::where('size_id', $size->id)->count() }})</span>
                                        <input {{ $size->id == @$_GET['size_id']?'checked':'' }} type="radio" class="size_id" name="size_id" value="{{ $size->id }}">
                                        <span class="topcoat-radio-button"></span>
                                    </label>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="filter-item">
                        <div class="shop-filter-item tag-widget">
                            <h2>Popular Tags</h2>
                            <ul>
                                @foreach ($tags as $tag)
                                <li>
                                    <label class="topcoat-radio-button__label">
                                        {{ $tag->tag_name }} <span></span>
                                        <input {{ $tag->id == @$_GET['tag_id']?'checked':'' }} type="radio" class="tag_id" name="size_id" value="{{ $tag->id }}">
                                        <span class="topcoat-radio-button"></span>
                                    </label>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="shop-section-top-inner">
                    <div class="shoping-product">
                        <p>We found <span>10 items</span> for you!</p>
                    </div>
                    <div class="short-by">
                        <ul>
                            <li>
                                Sort by:
                            </li>
                            <li>
                                <select name="show" class="sorting">
                                    <option value="">Default Sorting</option>
                                    <option value="1">Low To High</option>
                                    <option value="2">High To Low</option>
                                    <option value="3">A to Z</option>
                                    <option value="4">Z to A</option>
                                </select>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="product-wrap">
                    <div class="row align-items-center">
                        @forelse ($products as $product)
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="product-item">
                                <div class="image">
                                    <img src="{{ asset('uploads/product/preview') }}/{{ $product->preview }}" alt="">
                                    <div class="tag new">New</div>
                                </div>
                                <div class="text">
                                    <h2><a href="{{ route('product.details', $product->slug) }}">{{ $product->product_name}}</a></h2>
                                    <div class="rating-product">
                                        <i class="fi flaticon-star"></i>
                                        <i class="fi flaticon-star"></i>
                                        <i class="fi flaticon-star"></i>
                                        <i class="fi flaticon-star"></i>
                                        <i class="fi flaticon-star"></i>
                                        <span>130</span>
                                    </div>
                                    <div class="price">
                                        <span class="present-price">{{ $product->after_discount }}</span>
                                        <del class="old-price">{{ $product->price }}</del>
                                    </div>
                                    <div class="shop-btn">
                                        <a class="theme-btn-s2" href="{{ route('product.details', $product->slug) }}">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="alert alert-info">
                            <p>No Product Found</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- product-area-end -->
@endsection

@section('footer_script')
<script>
    $('#search_btn').click(function(){
        var search_input = $('#search_input').val();
        var category_id = $("input[type='radio'][class='category_id']:checked").val();
        var color_id = $("input[type='radio'][class='color_id']:checked").val();
        var size_id = $("input[type='radio'][class='size_id']:checked").val();
        var min = $('.min').val();
        var max = $('.max').val();
        var sorting = $('.sorting').val();
        var tag_id = $("input[type='radio'][class='tag_id']:checked").val();
        var link = "{{ route('shop') }}"+"?q="+search_input+"&category_id="+category_id+"&color_id="+color_id+"&size_id="+size_id+"&min="+min+"&max="+max+"&sorting="+sorting+"&tag_id="+tag_id;
        window.location.href = link;
    });
    $('.category_id').click(function(){
        var search_input = $('#search_input').val();
        var category_id = $("input[type='radio'][class='category_id']:checked").val();
        var color_id = $("input[type='radio'][class='color_id']:checked").val();
        var size_id = $("input[type='radio'][class='size_id']:checked").val();
        var min = $('.min').val();
        var max = $('.max').val();
        var sorting = $('.sorting').val();
        var tag_id = $("input[type='radio'][class='tag_id']:checked").val();
        var link = "{{ route('shop') }}"+"?q="+search_input+"&category_id="+category_id+"&color_id="+color_id+"&size_id="+size_id+"&min="+min+"&max="+max+"&sorting="+sorting+"&tag_id="+tag_id;
        window.location.href = link;
    });
    $('#range').click(function(){
        var search_input = $('#search_input').val();
        var category_id = $("input[type='radio'][class='category_id']:checked").val();
        var color_id = $("input[type='radio'][class='color_id']:checked").val();
        var size_id = $("input[type='radio'][class='size_id']:checked").val();
        var min = $('.min').val();
        var max = $('.max').val();
        var sorting = $('.sorting').val();
        var tag_id = $("input[type='radio'][class='tag_id']:checked").val();
        var link = "{{ route('shop') }}"+"?q="+search_input+"&category_id="+category_id+"&color_id="+color_id+"&size_id="+size_id+"&min="+min+"&max="+max+"&sorting="+sorting+"&tag_id="+tag_id;
        window.location.href = link;
    });
    $('.color_id').click(function(){
        var search_input = $('#search_input').val();
        var category_id = $("input[type='radio'][class='category_id']:checked").val();
        var color_id = $("input[type='radio'][class='color_id']:checked").val();
        var size_id = $("input[type='radio'][class='size_id']:checked").val();
        var min = $('.min').val();
        var max = $('.max').val();
        var sorting = $('.sorting').val();
        var tag_id = $("input[type='radio'][class='tag_id']:checked").val();
        var link = "{{ route('shop') }}"+"?q="+search_input+"&category_id="+category_id+"&color_id="+color_id+"&size_id="+size_id+"&min="+min+"&max="+max+"&sorting="+sorting+"&tag_id="+tag_id;
        window.location.href = link;
    });
    $('.size_id').click(function(){
        var search_input = $('#search_input').val();
        var category_id = $("input[type='radio'][class='category_id']:checked").val();
        var color_id = $("input[type='radio'][class='color_id']:checked").val();
        var size_id = $("input[type='radio'][class='size_id']:checked").val();
        var min = $('.min').val();
        var max = $('.max').val();
        var sorting = $('.sorting').val();
        var tag_id = $("input[type='radio'][class='tag_id']:checked").val();
        var link = "{{ route('shop') }}"+"?q="+search_input+"&category_id="+category_id+"&color_id="+color_id+"&size_id="+size_id+"&min="+min+"&max="+max+"&sorting="+sorting+"&tag_id="+tag_id;
        window.location.href = link;
    });
    $('.tag_id').click(function(){
        var search_input = $('#search_input').val();
        var category_id = $("input[type='radio'][class='category_id']:checked").val();
        var color_id = $("input[type='radio'][class='color_id']:checked").val();
        var size_id = $("input[type='radio'][class='size_id']:checked").val();
        var min = $('.min').val();
        var max = $('.max').val();
        var sorting = $('.sorting').val();
        var tag_id = $("input[type='radio'][class='tag_id']:checked").val();
        var link = "{{ route('shop') }}"+"?q="+search_input+"&category_id="+category_id+"&color_id="+color_id+"&size_id="+size_id+"&min="+min+"&max="+max+"&sorting="+sorting+"&tag_id="+tag_id;
        window.location.href = link;
    });
    $('.sorting').change(function(){
        var search_input = $('#search_input').val();
        var category_id = $("input[type='radio'][class='category_id']:checked").val();
        var color_id = $("input[type='radio'][class='color_id']:checked").val();
        var size_id = $("input[type='radio'][class='size_id']:checked").val();
        var min = $('.min').val();
        var max = $('.max').val();
        var sorting = $('.sorting').val();
        var tag_id = $("input[type='radio'][class='tag_id']:checked").val();
        var link = "{{ route('shop') }}"+"?q="+search_input+"&category_id="+category_id+"&color_id="+color_id+"&size_id="+size_id+"&min="+min+"&max="+max+"&sorting="+sorting+"&tag_id="+tag_id;
        window.location.href = link;
    });

    $('.search_btn').click(function(){
        var search_input = $('.search_input').val();
        var link = "{{ route('shop') }}"+"?q="+search_input;
        window.location.href = link;
    });
</script>
@endsection
