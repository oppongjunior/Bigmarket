<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontEndPagesController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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



Route::get('/admin/register', [AdminController::class, 'register'])->name('admin.register');
Route::post('/admin/register', [AdminController::class, 'create'])->name('admin.register');
Route::post('/update/adminInfo', [AdminController::class, 'updateInfo'])->name('admin.info');
Route::post('/update/adminPassword', [AdminController::class, 'adminPassword'])->name('admin.adminPassword');
Route::post('/update/adminImage', [AdminController::class, 'adminImage'])->name('admin.image');
Route::get('/admin/login', [AdminController::class, 'CreateAdmin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::get("/admin/dashboard", [AdminController::class, "dashboard"])->name("admin.dashboard")->middleware("auth:admin");
Route::get("/admin/profile", [AdminController::class, "profile"])->name("admin.profile")->middleware("auth:admin");
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');


Route::get("/user/register", [UserController::class, "register"])->name("user.register");
Route::post("/user/register", [UserController::class, "create"])->name("user.register");
Route::post('/update/userInfo', [UserController::class, 'updateInfo'])->name('user.info');
Route::post('/update/userPassword', [UserController::class, 'userPassword'])->name('user.Password');
Route::post('/update/userImage', [UserController::class, 'userImage'])->name('user.image');
Route::get("/user/login", [UserController::class, "CreateLogin"])->name("user.login");
Route::post("/user/login", [UserController::class, "login"])->name("user.login");
Route::get("/user/dashboard", [UserController::class, "dashboard"])->name("user.dashboard")->middleware("auth");
Route::get("/user/orders", [UserController::class, "orders"])->name("user.orders")->middleware("auth");
Route::get("/user/shipping", [UserController::class, "shipping"])->name("user.shipping")->middleware("auth");
Route::get("/user/logout", [UserController::class, "logout"])->name("user.logout")->middleware("auth");

//slider routes
Route::get("slider/all",[SliderController::class,"index"])->name("all.slider");
Route::get("slider/create",[SliderController::class,"create"])->name("add.slider");
Route::post("slider/add",[SliderController::class,"store"])->name("store.slider");
Route::get("slider/edit/{id}",[SliderController::class,"edit"]);
Route::post("slider/update/{id}",[SliderController::class,"update"]);
Route::get("slider/delete/{id}",[SliderController::class,"destroy"]);

///category routes
Route::get("category/all",[CategoryController::class,"index"])->name("all.category");
Route::post("category/add",[CategoryController::class,"store"])->name("store.category");
Route::get("category/edit/{id}",[CategoryController::class,"edit"]);
Route::post("category/update/{id}",[CategoryController::class,"update"]);
Route::get("category/softdelete/{id}",[CategoryController::class,"softDelete"]);
Route::get("category/restore/{id}",[CategoryController::class,"restore"]);
Route::get("category/pdelete/{id}",[CategoryController::class,"P_Delete"]);

//Product routes
Route::get("product/all",[ProductController::class,"index"])->name("all.product");
Route::get("product/create",[ProductController::class,"create"])->name("add.product");
Route::post("product/add",[ProductController::class,"store"])->name("store.product");
Route::get("product/edit/{id}",[ProductController::class,"edit"]);
Route::post("product/update/{id}",[ProductController::class,"update"]);
Route::get("product/softdelete/{id}",[ProductController::class,"softDelete"]);
Route::get("product/restore/{id}",[ProductController::class,"restore"]);
Route::get("product/pdelete/{id}",[ProductController::class,"destroy"]);


//brand routes
Route::get("brand/all",[BrandController::class,"index"])->name("all.brands");
Route::post("brand/add",[BrandController::class,"store"])->name("store.brand");
Route::get("brand/edit/{id}",[BrandController::class,"edit"]);
Route::post("brand/update/{id}",[BrandController::class,"update"]);
Route::get("brand/softdelete/{id}",[BrandController::class,"softDelete"]);
Route::get("brand/restore/{id}",[BrandController::class,"restore"]);
Route::get("brand/pdelete/{id}",[BrandController::class,"destroy"]);

//cart
Route::get("cart/all",[CartController::class, "cartpage"])->name("all.cart");
Route::post("cart/add",[CartController::class, "cartadd"]);



//Frontend pages route
//home page route
Route::get('/', [FrontEndPagesController::class, "Home"]);
//product page
Route::get("product/{id}",[FrontEndPagesController::class,"Product"]);
Route::get("sub-category/{id}",[FrontEndPagesController::class,"sub_category"]);
Route::post("search/product",[FrontEndPagesController::class,"search"]);
/*
Route::group(['middleware' => ['auth:admin']], function () {
    Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});
*/
