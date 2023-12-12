<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\City;
use App\Models\Color;
use App\Models\Country;
use App\Models\Coupon;
use App\Models\Delivery;
use App\Models\Inventory;
use App\Models\Logo;
use App\Models\Newyear;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Size;
use App\Models\Subs;
use App\Models\Tag;
use App\Models\Thumbnail;
use App\Models\Upcoming;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class FrontendController extends Controller
{
    function index(){
        $categories = Category::all();
        $products = Product::latest()->get();
        $upcoming_offers = Upcoming::latest()->get();
        $newyear_offers_70 = Newyear::where('percentage', 70)->get();
        $newyear_offers_50 = Newyear::where('percentage', 50)->get();
        $subs_content = Subs::all();
        $top_selling = OrderProduct::groupBy('product_id')
        ->selectRaw('sum(quantity) as sum, product_id')
        ->orderBy('sum', 'DESC')->take(3)->get();
        return view('frontend.index', [
            'categories'=>$categories,
            'products'=>$products,
            'upcoming_offers'=>$upcoming_offers,
            'newyear_offers_70'=>$newyear_offers_70,
            'newyear_offers_50'=>$newyear_offers_50,
            'subs_content'=>$subs_content,
            'top_selling'=> $top_selling,
        ]);
    }

    function product_details($slug){

        $product = Product::where('slug', $slug)->get();
        $product_id = $product->first()->id;
        $product_details = Product::find($product_id);
        $thumbnails =  Thumbnail::where('product_id', $product_id)->get();
        $related_products = Product::where('category_id', $product_details->category_id)->where('id', '!=', $product_id)->get();
        $available_colors = Inventory::where('product_id', $product_id)->groupBy('color_id')
        ->selectRaw('count(*) as total, color_id')
        ->get();
        $available_sizes = Inventory::where('product_id', $product_id)->groupBy('size_id')
        ->selectRaw('count(*) as total, size_id')
        ->get();
        $product_reviews = OrderProduct::where('product_id', $product_id)->whereNotNull('review')->get();
        $total_star = OrderProduct::where('product_id', $product_id)->whereNotNull('review')->sum('star');


        //recent view
        $al = Cookie::get('recent_view');
        if (!$al) {
            $al = "[]";
        }
        $all_info = json_decode($al, true);
        $all_info = Arr::prepend($all_info, $product_id);
        $recent_product_id = json_encode($all_info);
        Cookie::queue('recent_view', $recent_product_id, 1000);


        return view('frontend.product_details', [
            'product_details'=>$product_details,
            'thumbnails'=>$thumbnails,
            'related_products'=>$related_products,
            'available_colors'=>$available_colors,
            'available_sizes'=>$available_sizes,
            'product_reviews'=> $product_reviews,
            'total_star'=> $total_star,
        ]);
    }

    function getSize(Request $request){
        $available_sizes = Inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->get();
        $str = '';
        foreach ($available_sizes as $size){
            if($size->rel_to_size->size_name == 'NA'){
                $str .= '<li class="color"><input class="size_id" checked id="size' . $size->size_id . '" type="radio" name="size_id" value="' . $size->size_id . '"><label for="size' . $size->size_id . '">' . $size->rel_to_size->size_name . '</label></li>';
            }
            else{
                $str .= '<li class="color"><input class="size_id" id="size' . $size->size_id . '" type="radio" name="size_id" value="' . $size->size_id . '"><label for="size' . $size->size_id . '">' . $size->rel_to_size->size_name . '</label></li>';
            }

        }
        echo $str;
    }
    function getStock(Request $request){
        $stock = Inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->first()->quantity;
        return $stock;
    }

    function customer_login(){
        return view('frontend.customer.customer_login');
    }
    function customer_register(){
        return view('frontend.customer.customer_register');
    }

    function cart(Request $request){
        $carts = Cart::where('customer_id', Auth::guard('customer')->id())->get();
        $coupon_info = Coupon::where('coupon_name', $request->coupon)->get();
        $type = '';
        $amount = 0;
        $mesg = '';

        if($request->coupon != ''){
            if (Coupon::where('coupon_name', $request->coupon)->exists()) {
                if(Carbon::now()->format('Y-m-d') > $coupon_info->first()->validity){
                    $amount = 0;
                    $mesg = 'Coupon Code Expired';
                }
                else{
                    $type = $coupon_info->first()->type;
                    $amount = $coupon_info->first()->amount;
                }
            }
            else {
                $amount = 0;
                $mesg = 'Invalid Coupon Code';
            }
        }
        return view('frontend.cart', [
            'carts'=> $carts,
            'mesg'=> $mesg,
            'type'=> $type,
            'amount'=> $amount,
        ]);
    }

    function checkout(){
        $inside_charge = Delivery::where('type', 1)->first()->amount;
        $outside_charge = Delivery::where('type', 2)->first()->amount;
        $carts = Cart::where('customer_id', Auth::guard('customer')->id())->get();
        $countries = Country::all();
        $cities = City::all();
        return view('frontend.checkout', [
            'carts'=> $carts,
            'inside_charge'=> $inside_charge,
            'outside_charge'=> $outside_charge,
            'countries'=> $countries,
            'cities'=> $cities,
        ]);
    }

    function order_success(){
        return view('frontend.order_success');
    }

    function review_store(Request $request){
        OrderProduct::where('customer_id', $request->customer_id)->where('product_id', $request->product_id)->first()->update([
            'review'=>$request->review,
            'star'=>$request->stars,
        ]);
        return back()->with('review', 'Review Submitted successfully');
    }

    function offer_product(){
        $newyear_products = Product::where('new', 1)->whereBetween('discount',[0,70])->Paginate(3);
        return view('frontend.offer', [
            'newyear_products'=> $newyear_products,
        ]);
    }
    function Offer_getStatus(Request $request){
        Product::find($request->product_id)->update([
            'new'=>$request->status,
        ]);
    }

    function shop(Request $request){
        $data = $request->all();

        $sorting = 'created_at';
        $type = 'DESC';

        if(!empty($data['sorting']) && $data['sorting'] != '' && $data['sorting'] != 'undefined'){
            if($data['sorting'] == 1){
                $sorting = 'after_discount';
                $type = 'ASC';
            }
            elseif($data['sorting'] == 2){
                $sorting = 'after_discount';
                $type = 'DESC';
            }
            elseif($data['sorting'] == 3){
                $sorting = 'product_name';
                $type = 'ASC';
            }
            elseif($data['sorting'] == 4){
                $sorting = 'product_name';
                $type = 'DESC';
            }
        }

        $products = Product::where(function ($q) use ($data){

            $min = 1;
            if(!empty($data['min']) && $data['min'] != '' && $data['min'] != 'undefined'){
                $min = $data['min'];
            }
            $max = 100000000;
            if(!empty($data['max']) && $data['max'] != '' && $data['max'] != 'undefined'){
                $max = $data['max'];
            }

            if(!empty($data['q']) && $data['q'] != '' && $data['q'] != 'undefined'){
                $q->where(function ($q) use ($data){
                    $q->where('product_name','like', '%'.$data['q'].'%' );
                    $q->orWhere('long_desp','like', '%'.$data['q'].'%' );
                    $q->orWhere('short_desp','like', '%'.$data['q'].'%' );
                });
            }
            if(!empty($data['category_id']) && $data['category_id'] != '' && $data['category_id'] != 'undefined'){
                $q->where(function ($q) use ($data){
                    $q->where('category_id', $data['category_id']);
                });
            }
            if(!empty($data['tag_id']) && $data['tag_id'] != '' && $data['tag_id'] != 'undefined'){
                $q->where(function ($q) use ($data){
                    $all='';
                    foreach(Product::all() as $pro){
                        $explode = explode(',', $pro->tags);
                        if(in_array($data['tag_id'], $explode)){
                            $all .= $pro->id.',';
                        }
                    }
                    $implode = explode(',',$all);
                    $q->find($implode);

                });
            }
            if(!empty($data['min']) && $data['min'] != '' && $data['min'] != 'undefined' || !empty($data['max']) && $data['max'] != '' && $data['max'] != 'undefined'){
                    $q->whereBetween('after_discount', [$min, $max]);
            }

            if(!empty($data['color_id']) && $data['color_id'] != '' && $data['color_id'] != 'undefined' || !empty($data['size_id']) && $data['size_id'] != '' && $data['size_id'] != 'undefined'){
                $q->whereHas('rel_to_inventory', function($q) use($data){
                    if(!empty($data['color_id']) && $data['color_id'] != '' && $data['color_id']){
                        $q->whereHas('rel_to_color', function($q) use($data){
                            $q->where('colors.id', $data['color_id']);
                        });
                    }
                });
            }
            if(!empty($data['color_id']) && $data['color_id'] != '' && $data['color_id'] != 'undefined' || !empty($data['size_id']) && $data['size_id'] != '' && $data['size_id'] != 'undefined'){
                $q->whereHas('rel_to_inventory', function($q) use($data){
                    if(!empty($data['color_id']) && $data['color_id'] != '' && $data['color_id']){
                        $q->whereHas('rel_to_color', function($q) use($data){
                            $q->where('colors.id', $data['color_id']);
                        });
                    }
                    if(!empty($data['size_id']) && $data['size_id'] != '' && $data['size_id']){
                        $q->whereHas('rel_to_size', function($q) use($data){
                            $q->where('sizes.id', $data['size_id']);
                        });
                    }
                });
            }
        })->orderBy($sorting, $type)->get();
        $categories = Category::all();
        $colors = Color::all();
        $sizes = Size::all();
        $tags = Tag::all();
        return view('frontend.shop', [
            'products'=> $products,
            'categories'=> $categories,
            'colors'=> $colors,
            'sizes'=> $sizes,
            'tags'=> $tags,
        ]);
    }

    function recent_view(){
        $recent_viewed_product = json_decode(Cookie::get('recent_view'), true);
        if ($recent_viewed_product == NULL) {
            $recent_viewed_product = [];
            $recent_viewed_product = array_unique($recent_viewed_product);
        } else {
            $recent_viewed_product = array_unique($recent_viewed_product);
            $recent_viewed_product =  array_reverse($recent_viewed_product);
        }
        $recent_viewed_product = Product::find($recent_viewed_product);

        return view('frontend.recent',[
            'recent_viewed_product'=> $recent_viewed_product,
        ]);
    }
}
