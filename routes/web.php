<?php

use App\Http\Controllers\ProductController;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () { 
//     return view('welcome');
// });

Auth::routes(['verify' => true]);

// Frontend Controller
Route::get('/', 'FrontendController@Front')->name('Front');
Route::get('/product/{slug}', 'FrontendController@SingleProduct')->name('SingleProduct');
Route::get('/shop', 'FrontendController@Shop')->name('Shop');

// Home Controller
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users', 'HomeController@Users')->name('Users');

// Category Controller
Route::get('/category-list', 'CategoryController@CategoryList')->name('CategoryList');
Route::get('/category-add', 'CategoryController@CategoryAdd')->name('CategoryAdd');
Route::post('/category-post', 'CategoryController@CategoryPost')->name('CategoryPost');
Route::get('/category-edit/{id}', 'CategoryController@CategoryEdit')->name('CategoryEdit');
Route::post('/category-update', 'CategoryController@CategoryUpdate')->name('CategoryUpdate');
Route::get('/category-restore/{id}', 'CategoryController@CategoryRestore')->name('CategoryRestore');
Route::get('/category-delete/{id}', 'CategoryController@CategoryDelete')->name('CategoryDelete');
Route::get('/category-permanent-delete/{id}', 'CategoryController@CategoryPermanentDelete')->name('CategoryPermanentDelete');
Route::post('/selected-category-delete', 'CategoryController@SelectedCategoryDelete')->name('SelectedCategoryDelete');


/**
 * Sub Category Controller
 */
Route::get('/sub-category-list', 'SubCategoryController@SubCategoryList')->name('SubCategoryList');
Route::get('/sub-category-add', 'SubCategoryController@SubCategoryAdd')->name('SubCategoryAdd');
Route::post('/sub-category-post', 'SubCategoryController@SubCategoryPost')->name('SubCategoryPost');
Route::get('/sub-category-restore/{id}', 'SubCategoryController@SubCategoryRestore')->name('SubCategoryRestore');
Route::get('/sub-category-delete/{id}', 'SubCategoryController@SubCategoryDelete')->name('SubCategoryDelete');
Route::get('/sub-category-permanent-delete/{id}', 'SubCategoryController@SubCategoryParmanentDelete')->name('SubCategoryParmanentDelete');
Route::get('/sub-category-edit/{id}', 'SubCategoryController@SubCategoryEdit')->name('SubCategoryEdit');
Route::post('/sub-category-update', 'SubCategoryController@SubCategoryUpdate')->name('SubCategoryUpdate'); 
Route::post('/selected-sub-category-delete', 'SubCategoryController@SelectedSubCategoryDelete')->name('SelectedSubCategoryDelete');

/**
 * Product Controller
 */
Route::get('/product-list', 'ProductController@Products')->name('Products');

Route::get('/product-add', 'ProductController@ProductAdd')->name('ProductAdd');
Route::post('/product-post', 'ProductController@ProductPost')->name('ProductPost');

Route::get('/product-edit/{slug}', 'ProductController@ProductEdit')->name('ProductEdit');
Route::post('/product-update', 'ProductController@ProductUpdate')->name('ProductUpdate');

Route::get('/product/gallery-update/{slug}', 'ProductController@GalleryEdit')->name('GalleryEdit');
Route::get('/product/gallery-image-delete/{id}', 'ProductController@GalleryImageDelete')->name('GalleryImageDelete');

Route::post('/product/images-update', 'ProductController@MultiImageUpdate')->name('MultiImageUpdate');

Route::get('/product-delete/{id}', 'ProductController@ProductDelete')->name('ProductDelete');

/**
 * Ajax Routing
 */
Route::get('/product-update/ajax/{id}', 'ProductController@ProductUpdateAjax')->name('ProductUpdateAjax');

/**
 * Add Brand, Color, Size
 */
Route::get('/add-brand', 'AttributeController@AddBrand')->name('AddBrand');
Route::post('/add-brand-post', 'AttributeController@AddBrandPost')->name('AddBrandPost');
Route::get('/add-color', 'AttributeController@AddColor')->name('AddColor');
Route::post('/add-color-post', 'AttributeController@AddColorPost')->name('AddColorPost');
Route::get('/add-size', 'AttributeController@AddSize')->name('AddSize');
Route::post('/add-size-post', 'AttributeController@AddSizePost')->name('AddSizePost');

/**
 * Ajax Get Size
 */
Route::get('product/get/size/{color}/{product}', 'FrontendController@GetSize')->name('GetSize');
Route::get('api/get-state-list/{country_id}', 'CheckoutController@GetState')->name('GetState');
Route::get('api/get-city-list/{cities}', 'CheckoutController@GetCity')->name('GetCity');

/**
 * Payment Controller
 */
Route::post('/payment', 'PaymentController@Payment')->name('Payment');


/**
 * Cart Routing
 */
Route::post('/add-to-cart', 'CartController@AddToCart')->name('AddToCart');
Route::post('/cart-update', 'CartController@CartUpdate')->name('CartUpdate');
Route::get('/cart/single-delete/{cart_id}', 'CartController@SingleCartDelete')->name('SingleCartDelete');

// Route::get('/cart', 'CartController@Cart')->name('Cart');
Route::get('/cart', 'CartController@Cart')->name('Cart');

/**
 * Checkout Controller
 */
Route::get('/checkout', 'CheckoutController@Checkout')->name('Checkout');


/**
 * Coupopn Controller
 */
Route::get('/coupon-list', 'CouponController@CoupponList')->name('CoupponList');
Route::get('/add-coupon', 'CouponController@CouponAdd')->name('CouponAdd');
Route::post('/coupon-store', 'CouponController@CouponStore')->name('CouponStore');
Route::get('/coupon-delete', 'CouponController@CouponDelete')->name('CouponDelete');
//Route::get('/coupon-apply', 'CouponController@ApplyCoupon')->name('ApplyCoupon');

/**
 * Order Route
 */
Route::get('/orders', 'HomeController@Orders')->name('Orders');
Route::get('/orders/excel/download', 'HomeController@ExcelDownload')->name('ExcelDownload');
Route::post('/category/excel/import', 'HomeController@CategoryImport')->name('CategoryImport');
Route::post('/category/excel/export-selected', 'HomeController@SelectedDateExcelDownload')->name('SelectedDateExcelDownload');