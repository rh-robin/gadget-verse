<?php

use App\Http\Controllers\AdminController;

use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\SubSubCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\ReviewController;


// frontend controllers
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\AllUserController;


use App\Models\User;

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/





/* route for admin login */
Route::middleware('admin:admin')->group(function () {
    Route::get('admin/login',[AdminController::class,'loginForm'])->name('admin.logiin');
    Route::post('admin/login',[AdminController::class,'store'])->name('admin.login');
    
});

/* ********** admin all routes ************* */
Route::middleware([
    'auth:sanctum,admin', config('jetstream.auth_session'),'verified',
    ])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('admin.dashboard')->middleware('auth:admin');
}); 

Route::prefix('admin')->middleware('auth:admin')->group(function () {

    /* Admin profile related all routes */
    Route::get('logout', [AdminController::class, 'destroy'])->name('admin.logout');
    Route::get('profile', [AdminProfileController::class, 'adminProfile'])->name('admin.profile');
    Route::get('profile/edit', [AdminProfileController::class, 'adminProfileEdit'])->name('admin.profile.edit');
    Route::post('profile/update', [AdminProfileController::class, 'adminProfileUpdate'])->name('admin.profile.update');
    Route::get('profile/change_password', [AdminProfileController::class, 'adminProfileChangePass'])->name('admin.profile.change_password');
    Route::post('profile/update_password', [AdminProfileController::class, 'adminProfileUpdatePass'])->name('admin.profile.update_password');

    /* admin brand routes */
    Route::prefix('brand')->group(function () {
        Route::get('/view',[BrandController::class,'view'])->name('brand.view');
        Route::post('/store',[BrandController::class,'store'])->name('brand.store');
        Route::get('/edit/{id}',[BrandController::class,'edit'])->name('brand.edit');
        Route::post('/update',[BrandController::class,'update'])->name('brand.update');
        Route::get('/delete/{id}',[BrandController::class,'delete'])->name('brand.delete');
    }); // end all brand routes


    
    /* admin category routes */
    Route::prefix('category')->group(function () {
        /*  parent category  */
        Route::get('/view',[CategoryController::class,'view'])->name('category.view');
        Route::post('/store',[CategoryController::class,'store'])->name('category.store');
        Route::get('/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
        Route::post('/update',[CategoryController::class,'update'])->name('category.update');
        Route::get('/delete/{id}',[CategoryController::class,'delete'])->name('category.delete');
        Route::get('/active/{id}',[CategoryController::class,'active'])->name('category.active');
        Route::get('/inactive/{id}',[CategoryController::class,'inactive'])->name('category.inactive');

        /*  sub category  */
        Route::get('/sub/view',[SubCategoryController::class,'view'])->name('subcategory.view');
        Route::post('/sub/store',[SubCategoryController::class,'store'])->name('subcategory.store');
        Route::get('/sub/edit/{id}',[SubCategoryController::class,'edit'])->name('subcategory.edit');
        Route::post('/sub/update',[SubCategoryController::class,'update'])->name('subcategory.update');
        Route::get('/sub/delete/{id}',[SubCategoryController::class,'delete'])->name('subcategory.delete');
        Route::get('/sub/active/{id}',[SubCategoryController::class,'active'])->name('subcategory.active');
        Route::get('/sub/inactive/{id}',[SubCategoryController::class,'inactive'])->name('subcategory.inactive');

        /*  sub sub-category  */
        Route::get('/sub/sub/view',[SubSubCategoryController::class,'view'])->name('subsubcategory.view');
        Route::get('/subcategory/ajax/{category_id}',[SubSubCategoryController::class,'getSubCategory']);  /* get category wise sub-category */
        Route::get('/subsubcategory/ajax/{subcategory_id}',[SubSubCategoryController::class,'getSubsubCategory']);  /* get subcategory wise sub sub-category */
        Route::post('/sub/sub/store',[SubSubCategoryController::class,'store'])->name('subsubcategory.store');
        Route::get('/sub/sub/edit/{id}',[SubSubCategoryController::class,'edit'])->name('subsubcategory.edit');
        Route::post('/sub/sub/update',[SubSubCategoryController::class,'update'])->name('subsubcategory.update');
        Route::get('/sub/sub/delete/{id}',[SubSubCategoryController::class,'delete'])->name('subsubcategory.delete');
        Route::get('/sub/sub/active/{id}',[SubSubCategoryController::class,'active'])->name('subsubcategory.active');
        Route::get('/sub/sub/inactive/{id}',[SubSubCategoryController::class,'inactive'])->name('subsubcategory.inactive');
    }); // end all category routes

    /* admin product routes */
    Route::prefix('product')->group(function () {
        Route::get('/view',[ProductController::class,'view'])->name('product.view');
        Route::get('/add',[ProductController::class,'add'])->name('product.add');
        Route::post('/store',[ProductController::class,'store'])->name('product.store');
        Route::get('/edit/{id}',[ProductController::class,'edit'])->name('product.edit');
        Route::post('/data/update',[ProductController::class,'dataUpdate'])->name('product.dataUpdate');
        Route::post('/multi-img/update',[ProductController::class,'multiImgUpdate'])->name('product.multiImgUpdate');
        Route::post('/thumbnail/update',[ProductController::class,'thumbnailUpdate'])->name('product.thumbnailUpdate');
        Route::get('/multi-img/delete/{id}',[ProductController::class,'multiImgDelete'])->name('product.multiImgDelete');
        Route::get('/active/{id}',[ProductController::class,'active'])->name('product.active');
        Route::get('/inactive/{id}',[ProductController::class,'inactive'])->name('product.inactive');
        Route::get('/delete/{id}',[ProductController::class,'delete'])->name('product.delete');
    });

    /* admin slider routes */
    Route::prefix('slider')->group(function () {
        Route::get('/view',[SliderController::class,'view'])->name('slider.view');
        Route::get('/add',[SliderController::class,'add'])->name('slider.add');
        Route::post('/store',[SliderController::class,'store'])->name('slider.store');
        Route::get('/edit/{id}',[SliderController::class,'edit'])->name('slider.edit');
        Route::post('/update',[SliderController::class,'update'])->name('slider.update');
        Route::get('/active/{id}',[SliderController::class,'active'])->name('slider.active');
        Route::get('/inactive/{id}',[SliderController::class,'inactive'])->name('slider.inactive');
        Route::get('/delete/{id}',[SliderController::class,'delete'])->name('slider.delete');
    }); // end all slider routes

    /* admin coupon routes */
    Route::prefix('coupon')->group(function () {
        Route::get('/view',[CouponController::class,'view'])->name('coupon.view');
        Route::post('/store',[CouponController::class,'store'])->name('coupon.store');
        Route::get('/edit/{id}',[CouponController::class,'edit'])->name('coupon.edit');
        Route::post('/update/{id}',[CouponController::class,'update'])->name('coupon.update');
        Route::get('/active/{id}',[CouponController::class,'active'])->name('coupon.active');
        Route::get('/inactive/{id}',[CouponController::class,'inactive'])->name('coupon.inactive');
        Route::get('/delete/{id}',[CouponController::class,'delete'])->name('coupon.delete');
    }); // end all coupon routes

    /* admin shipping routes */
    Route::prefix('shipping')->group(function () {
        //divisions
        Route::get('/division/view',[ShippingAreaController::class,'divisionView'])->name('division.view');
        Route::post('/division/store',[ShippingAreaController::class,'divisionStore'])->name('division.store');
        Route::get('/division/edit/{id}',[ShippingAreaController::class,'divisionEdit'])->name('division.edit');
        Route::post('/division/update/{id}',[ShippingAreaController::class,'divisionUpdate'])->name('division.update');
        Route::get('/division/active/{id}',[ShippingAreaController::class,'divisionActive'])->name('division.active');
        Route::get('/division/inactive/{id}',[ShippingAreaController::class,'divisionInactive'])->name('division.inactive');
        Route::get('/division/delete/{id}',[ShippingAreaController::class,'divisionDelete'])->name('division.delete');

        //districts
        Route::get('/district/view',[ShippingAreaController::class,'districtView'])->name('district.view');
        Route::post('/district/store',[ShippingAreaController::class,'districtStore'])->name('district.store');
        Route::get('/district/edit/{id}',[ShippingAreaController::class,'districtEdit'])->name('district.edit');
        Route::post('/district/update/{id}',[ShippingAreaController::class,'districtUpdate'])->name('district.update');
        Route::get('/district/active/{id}',[ShippingAreaController::class,'districtActive'])->name('district.active');
        Route::get('/district/inactive/{id}',[ShippingAreaController::class,'districtInactive'])->name('district.inactive');
        Route::get('/district/delete/{id}',[ShippingAreaController::class,'districtDelete'])->name('district.delete');
    }); // end all shipping routes

    /* admin order routes */
    Route::prefix('order')->group(function () {
        Route::get('/pending/view',[OrderController::class,'pendingOrders'])->name('order.pending.view');
        Route::get('/details/{id}',[OrderController::class,'orderDetails'])->name('order.details');
        Route::get('/accepted/view',[OrderController::class,'acceptedOrders'])->name('order.accepted.view');
        Route::get('/processing/view',[OrderController::class,'processingOrders'])->name('order.processing.view');
        Route::get('/picked/view',[OrderController::class,'pickedOrders'])->name('order.picked.view');
        Route::get('/shipped/view',[OrderController::class,'shippedOrders'])->name('order.shipped.view');
        Route::get('/delivered/view',[OrderController::class,'deliveredOrders'])->name('order.delivered.view');
        Route::get('/canceled/view',[OrderController::class,'canceledOrders'])->name('order.canceled.view');

        //update status
        Route::get('/pending/accept/{id}',[OrderController::class,'pendingToAccept'])->name('pending-accept');
        Route::get('/pending/cancel/{id}',[OrderController::class,'pendingToCancel'])->name('pending-cancel');
        Route::get('/accept/processing/{id}',[OrderController::class,'acceptToProcessing'])->name('accept-processing');
        Route::get('/processing/picked/{id}',[OrderController::class,'processingToPicked'])->name('processing-picked');
        Route::get('/picked/shipped/{id}',[OrderController::class,'pickedToShipped'])->name('picked-shipped');
        Route::get('/shipped/delivered/{id}',[OrderController::class,'shippedToDelivered'])->name('shipped-delivered');

        //invoice download
        Route::get('/invoice/download/{id}',[OrderController::class,'invoiceDownload'])->name('invoice.download');
    }); // end all order routes


    /* admin report routes */
    Route::prefix('report')->group(function () {
        Route::get('/search',[ReportController::class,'searchReport'])->name('report.search');
        Route::post('/date',[ReportController::class,'reportByDate'])->name('report-by-date');
        Route::post('/month',[ReportController::class,'reportByMonth'])->name('report-by-month');
        Route::post('/year',[ReportController::class,'reportByYear'])->name('report-by-year');
    }); // end all report routes

    /* admin users routes */
    Route::prefix('user')->group(function () {
        Route::get('/all',[AdminProfileController::class,'allUsers'])->name('user.all');
    }); // end all users routes

    /* admin settings routes */
    Route::prefix('settings')->group(function () {
        Route::get('/site',[SettingController::class,'siteSetting'])->name('site.setting');
        Route::post('/site',[SettingController::class,'settingUpdate'])->name('setting.update');
    }); // end all settings routes

    /* admin settings routes */
    Route::prefix('review')->group(function () {
        Route::get('/',[ReviewController::class,'view'])->name('review.view');
        Route::get('/edit/{id}',[ReviewController::class,'edit'])->name('review.edit');
        Route::post('/update',[ReviewController::class,'update'])->name('review.update');
        Route::get('/approve/{id}',[ReviewController::class,'approve'])->name('review.approve');
        Route::get('/reject/{id}',[ReviewController::class,'reject'])->name('review.reject');
        Route::get('/delete/{id}',[ReviewController::class,'delete'])->name('review.delete');
    }); // end all settings routes
    
}); /* ********** end admin all routes ************* */






/* all routes for user */

Route::get('/',[IndexController::class,'index']);
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('dashboard', compact('user'));
    })->name('dashboard');
});







/* ******************* frontend all routes ****************** */
/* ******* language all routes ******** */
/* Route::get('/language/english',[LanguageController::class,'english'])->name('language.english');
Route::get('/language/bangla',[LanguageController::class,'bangla'])->name('language.bangla'); */

// Frontend Product Details Page url 
Route::get('/product/details/{id}/{slug}', [IndexController::class, 'productDetails'])->name('product.details');
Route::get('/fetch-varaition/{id}/{size}/{color}', [IndexController::class, 'fetchVariation']);
//product quickview
Route::get('/product/quickview/{id}', [IndexController::class, 'productQuickview']);



/* =================== category wise product =================== */
Route::get('/category/{id}/{slug}', [IndexController::class, 'categoryWiseProduct'])->name('category.product');
Route::get('/subcategory/{id}/{slug}', [IndexController::class, 'subCategoryWiseProduct'])->name('subcategory.product');
Route::get('/subsubcategory/{id}/{slug}', [IndexController::class, 'subSubCategoryWiseProduct'])->name('subsubcategory.product');


/* ============= cart route =========== */
Route::post('/cart/data/store/{id}', [CartController::class, 'addToCart']);
Route::GET('/cart/data/remove/{id}', [CartController::class, 'removeFromCart']);
Route::GET('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::GET('/cart/get-content', [CartController::class, 'getCartContent']);
Route::get('/product/minicart', [CartController::class, 'miniCart']);
Route::get('/cart/item/increment/{id}', [CartController::class, 'cartIncrement']);
Route::get('/cart/item/decrement/{id}', [CartController::class, 'cartDecrement']);


/* =========== coupon apply =========== */
Route::post('/coupon-apply', [CartController::class, 'couponApply']);
Route::get('/coupon-calculation', [CartController::class, 'couponCalculation']);
Route::get('/coupon-remove', [CartController::class, 'couponRemove']);


/* =========== refer-code apply =========== */
Route::post('/refer-code-apply', [CartController::class, 'referCodeApply']);
Route::get('/refer-calculation', [CartController::class, 'referCalculation']);
Route::get('/refer-remove', [CartController::class, 'referRemove']);



Route::group(['middleware' => ['auth'], 'namespace' => 'user'], function(){
    /* =========== checkout =========== */
    Route::get('/checkout', [CheckoutController::class, 'createCheckout'])->name('checkout');
    Route::get('/get-district-ajax/{id}', [CheckoutController::class, 'getDistrict']);
    Route::get('/get-shipping-charge/{value}', [CheckoutController::class, 'getShippingCharge']);

    /* =========== review =========== */
    Route::post('/submit-review', [ReviewController::class, 'submitReview']);
});



/* =========== user routes with middleware ========== */
Route::group(['prefix' => 'user', 'middleware' => ['auth'], 'namespace' => 'user'], function(){
    Route::get('/logout',[UserController::class,'userLogout'])->name('user.logout');
    Route::get('/profile',[UserController::class,'userProfile'])->name('user.profile');
    Route::post('/profile/store',[UserController::class,'userProfileStore'])->name('user.profile.store');
    Route::get('/change-password',[UserController::class,'userChangePassword'])->name('user.changePassword');
    Route::post('/update-password',[UserController::class,'userUpdatePassword'])->name('user.updatePassword');
    
    Route::post('/order/create', [CheckoutController::class, 'orderCreate'])->name('order.create');
    Route::get('/order/completion/{id}', [CheckoutController::class, 'orderCompletion'])->name('order.completion');
    Route::get('/order/confirm/{id}', [CheckoutController::class, 'orderConfirm'])->name('order.confirm');

    Route::get('/orders', [AllUserController::class, 'userAllOrders'])->name('user.orders');
    Route::get('/order/{id}', [AllUserController::class, 'orderDetails'])->name('user.order.details');
    Route::get('/order/invoice/{id}', [AllUserController::class, 'invoiceDownload'])->name('user.order.invoice');
});







Route::get('/phpinfo', function () {
    phpinfo();
});
