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
Route::get('product/{slug}', 'FrontendController@SingleProduct')->name('SingleProduct');

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

// Sub Category Controller
Route::get('/sub-category-list', 'SubCategoryController@SubCategoryList')->name('SubCategoryList');
Route::get('/sub-category-add', 'SubCategoryController@SubCategoryAdd')->name('SubCategoryAdd');
Route::post('/sub-category-post', 'SubCategoryController@SubCategoryPost')->name('SubCategoryPost');
Route::get('/sub-category-restore/{id}', 'SubCategoryController@SubCategoryRestore')->name('SubCategoryRestore');
Route::get('/sub-category-delete/{id}', 'SubCategoryController@SubCategoryDelete')->name('SubCategoryDelete');
Route::get('/sub-category-permanent-delete/{id}', 'SubCategoryController@SubCategoryParmanentDelete')->name('SubCategoryParmanentDelete');
Route::get('/sub-category-edit/{id}', 'SubCategoryController@SubCategoryEdit')->name('SubCategoryEdit');
Route::post('/sub-category-update', 'SubCategoryController@SubCategoryUpdate')->name('SubCategoryUpdate');

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

/**
 * Ajax Routing
 */
Route::get('/product-update/ajax/{id}', 'ProductController@ProductUpdateAjax')->name('ProductUpdateAjax');

/**
 * Add Brand, Color, Size
 */
Route::get('/add-brand', 'ProductController@AddBrand')->name('AddBrand');
Route::post('/add-brand-post', 'ProductController@AddBrandPost')->name('AddBrandPost');
Route::get('/add-color', 'ProductController@AddColor')->name('AddColor');
Route::post('/add-color-post', 'ProductController@AddColorPost')->name('AddColorPost');
Route::get('/add-size', 'ProductController@AddSize')->name('AddSize');
Route::post('/add-size-post', 'ProductController@AddSizePost')->name('AddSizePost');