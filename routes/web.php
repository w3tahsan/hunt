<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerLoginController;
use App\Http\Controllers\CustomerRegisterController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

//frontend start
Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/product/details/{slug}', [FrontendController::class, 'product_details'])->name('product.details');
Route::get('/customer/login', [FrontendController::class, 'customer_login'])->name('customer.login');
Route::get('/customer/register', [FrontendController::class, 'customer_register'])->name('customer.register');
Route::get('/cart', [FrontendController::class, 'cart'])->name('cart');
Route::get('/checkout', [FrontendController::class, 'checkout'])->name('checkout');
Route::get('/order/success', [FrontendController::class, 'order_success'])->name('order.success');
Route::post('/product/review', [FrontendController::class, 'review_store'])->name('review.store');
Route::get('/offers/product', [FrontendController::class, 'offer_product'])->name('offer.product');
Route::post('/offer/status/change', [FrontendController::class, 'Offer_getStatus']);
Route::get('/shop', [FrontendController::class, 'shop'])->name('shop');
Route::get('/recent/view', [FrontendController::class, 'recent_view'])->name('recent.view');


//backend start
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//profile
Route::get('/profile', [UserController::class, 'profile'])->name('profile');
Route::post('/profile/update', [UserController::class, 'profile_update'])->name('profile.update');
Route::post('/profile/photo/update', [UserController::class, 'profile_photo_update'])->name('profile.photo.update');

//User
Route::get('/user/list',[UserController::class, 'user_list'])->name('user.list');
Route::get('/user/delete/{user_id}',[UserController::class, 'user_delete'])->name('user.delete');

//Category
Route::get('/category', [CategoryController::class, 'category'])->name('add.category');
Route::post('/category/store', [CategoryController::class, 'category_store'])->name('category.store');
Route::get('/category/soft/delete/{category_id}', [CategoryController::class, 'category_soft_delete'])->name('category.soft.delete');
Route::get('/trash/category', [CategoryController::class, 'trash_category'])->name('trash.category');
Route::get('/category/delete/{category_id}', [CategoryController::class, 'category_delete'])->name('category.delete');
Route::get('/category/restore/{category_id}', [CategoryController::class, 'category_restore'])->name('category.restore');
Route::post('/checked/delete', [CategoryController::class, 'checked_delete'])->name('checked.delete');
Route::get('/category/edit/{category_id}', [CategoryController::class, 'category_edit'])->name('category.edit');
Route::post('/category/update', [CategoryController::class, 'category_update'])->name('category.update');
Route::post('/checked/delete/permanent', [CategoryController::class, 'checked_delete_permanent'])->name('checked.delete.permanent');


//Subcategory
Route::get('/subcategory', [SubcategoryController::class, 'subcategory'])->name('subcategory');
Route::post('/subcategory/store', [SubcategoryController::class, 'subcategory_store'])->name('subcategory.store');
Route::get('/subcategory/edit/{sub_cat_id}', [SubcategoryController::class, 'subcategory_edit'])->name('subcategory.edit');
Route::post('/subcategory/update/{sub_cat_id}', [SubcategoryController::class, 'subcategory_update'])->name('subcategory.update');
Route::get('/subcategory/delete/{sub_cat_id}', [SubcategoryController::class, 'subcategory_delete'])->name('subcatgory.delete');

//brand
Route::get('/brand', [BrandController::class, 'brand'])->name('brand');
Route::post('/brand/store', [BrandController::class, 'brand_store'])->name('brand.store');

//Product
Route::get('/add/product', [ProductController::class, 'add_product'])->name('add.product');
Route::post('/getSubcategory', [ProductController::class, 'getSubcategory']);
Route::post('/product/store', [ProductController::class, 'product_store'])->name('product.store');
Route::get('/product/list', [ProductController::class, 'product_list'])->name('product.list');
Route::get('/add/color/size', [InventoryController::class, 'add_color_size'])->name('add.color.size');
Route::post('/color/store', [InventoryController::class, 'color_store'])->name('color.store');
Route::post('/size/store', [InventoryController::class, 'size_store'])->name('size.store');
Route::get('/inventory/{product_id}', [InventoryController::class, 'inventory'])->name('inventory');
Route::post('/inventory/store', [InventoryController::class, 'inventory_store'])->name('inventory.store');

//Upcoming Offer
Route::get('upcoming/offer', [OfferController::class, 'upcoming_offer'])->name('upcoming.offer');
Route::post('upcoming/store', [OfferController::class, 'upcoming_store'])->name('upcoming.store');

//New Year Offer
Route::get('newyear/offer', [OfferController::class, 'newyear_offer'])->name('newyear.offer');
Route::post('newyear/store', [OfferController::class, 'newyear_store'])->name('newyear.store');

//logo
Route::get('/logo', [LogoController::class, 'logo'])->name('logo');
Route::post('/mainlogo/update', [LogoController::class, 'mainlogo_update'])->name('mainlogo.update');
Route::post('/footerlogo/update', [LogoController::class, 'footerlogo_update'])->name('footerlogo.update');

//Social
Route::get('/social', [SocialController::class, 'social'])->name('social');
Route::post('/social/store', [SocialController::class, 'social_store'])->name('social.store');

//Subscriber part
Route::post('/subscribe/store', [SubscriberController::class, 'subscribe_store'])->name('subscribe.store');
Route::get('/subscribe', [SubscriberController::class, 'subscribe'])->name('subscribe');
Route::post('/subs/update', [SubscriberController::class, 'subs_update'])->name('subs.update');

//GetSize
Route::post('/getSize', [FrontendController::class, 'getSize']);
Route::post('/getStock', [FrontendController::class, 'getStock']);


//customer Login/Register
Route::post('/customer/register/store', [CustomerRegisterController::class, 'customer_register_store'])->name('customer.register.store');
Route::post('customer/login/req', [CustomerLoginController::class, 'customer_login_req'])->name('customer.login.req');
Route::get('customer/logout', [CustomerLoginController::class, 'customer_logout'])->name('customer.logout');

//Customer
Route::get('/customer/profile', [CustomerController::class, 'customer_profile'])->name('customer.prtofile');
Route::post('/customer/profile/update', [CustomerController::class, 'customer_profile_update'])->name('profile.update');
Route::get('/customer/password/change', [CustomerController::class, 'customer_password_change'])->name('customer.password.change');
Route::post('/customer/password/update', [CustomerController::class, 'customer_password_update'])->name('customer.pass.update');
Route::get('/customer/order', [CustomerController::class, 'customer_order'])->name('customer.order');
Route::get('/invoice/download/{id}', [CustomerController::class, 'invoice_download'])->name('download.invoice');


//Cart
Route::post('/cart/store', [CartController::class, 'cart_store'])->name('cart.store');
Route::get('/cart/remove/{cart_id}', [CartController::class, 'cart_remove'])->name('cart.remove');
Route::post('/cart/update', [CartController::class, 'cart_update'])->name('cart.update');

//Coupon
Route::get('/coupon', [CouponController::class, 'coupon'])->name('coupon');
Route::post('/coupon/store', [CouponController::class, 'coupon_store'])->name('coupon.store');

//delivery
Route::get('/delivery', [DeliveryController::class, 'delivery'])->name('delivery.charge');
Route::post('/delivery/store', [DeliveryController::class, 'delivery_store'])->name('delivery.store');

//checkout
Route::post('/checkout/store', [CheckoutController::class, 'checkout_store'])->name('checkout.store');
Route::post('/getCity', [CheckoutController::class, 'getCity']);


//Order
Route::get('/order', [OrderController::class, 'order'])->name('order');
Route::post('/order/update/{id}', [OrderController::class, 'order_update'])->name('order.status.update');

// SSLCOMMERZ Start
Route::get('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END


Route::controller(StripePaymentController::class)->group(function () {
    Route::get('stripe', 'stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});


//Role manager
Route::get('/role/manager', [RoleController::class, 'role_manager'])->name('role.manager');
Route::post('/permission/store', [RoleController::class, 'permission_store'])->name('permission.store');
Route::post('/role/store', [RoleController::class, 'role_store'])->name('role.store');
Route::post('/assign/role', [RoleController::class, 'assign_role'])->name('assign.role');
Route::get('/remove/role/{id}', [RoleController::class, 'remove_role'])->name('remove.role');
Route::get('/edit/role/{id}', [RoleController::class, 'edit_role'])->name('edit.role');
Route::post('/update/role', [RoleController::class, 'update_role'])->name('update.role');

//Tag
Route::get('/tags', [TagController::class, 'tags'])->name('tags');
Route::post('/tags/store', [TagController::class, 'tag_store'])->name('tag.store');

Route::get('/cat', [HomeController::class, 'cat'])->name('cat');


