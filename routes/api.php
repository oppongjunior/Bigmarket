<?php

use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/
Route::get("/user/register", [UserController::class, "register"])->name("user.register");
Route::post("/user/register", [UserController::class, "create"])->name("user.register");
Route::post('/update/userInfo', [UserController::class, 'updateInfo'])->name('user.info');
Route::post('/update/username', [UserController::class, 'updateName'])->name('user.name');
Route::post('/update/useremail', [UserController::class, 'updateEmail'])->name('user.email');
Route::post('/update/usertel', [UserController::class, 'updateTel'])->name('user.tel');
//Route::post('/update/userPassword', [UserController::class, 'userPassword'])->name('user.Password');
Route::post('/update/userImage', [UserController::class, 'userImage'])->name('user.image');
Route::post("/user/login", [UserController::class, "login"])->name("user.login");
Route::get("/user/orders", [UserController::class, "orders"])->name("user.orders")->middleware("auth");
Route::get("/user/shipping", [UserController::class, "shipping"])->name("user.shipping")->middleware("auth");
Route::get("/user/follow/{user_id}/{supplier_id}",[UserController::class,"followSupplier"]);
Route::get("/user/unfollow/{user_id}/{supplier_id}",[UserController::class,"unfollowSupplier"]);
Route::get("/user/suppliers/{user_id}",[UserController::class,"mySuppliers"]);
Route::get("/users",[UserController::class,"getUsers"]);
//cart
Route::get("/user/{id}/cart",[CartController::class,"getCart"]);
Route::post("/user/addcart",[CartController::class,"addToCart"]);
Route::post("/user/removecart",[CartController::class,"removeCart"]);
Route::post("/user/modifycart",[CartController::class,"modifyCart"]);


Route::post('/supplier/register', [SupplierController::class, 'create'])->name('supplier.register');
Route::post('/update/supplierInfo', [SupplierController::class, 'updateInfo'])->name('supplier.info');
Route::post('/update/suppliername', [SupplierController::class, 'updateName'])->name('supplier.name');
Route::post('/update/supplieremail', [SupplierController::class, 'updateEmail'])->name('supplier.email');
Route::post('/update/suppliertel', [SupplierController::class, 'updateTel'])->name('supplier.tel');
//Route::post('/update/userPassword', [UserController::class, 'userPassword'])->name('user.Password');
Route::post('/update/supplierImage', [SupplierController::class, 'supplierImage'])->name('supplier.image');
//Route::post('/update/adminPassword', [SupplierController::class, 'supplierPassword'])->name('supplier.supplierPassword');
Route::post('/supplier/login', [SupplierController::class, 'login'])->name('supplier.login');
Route::get("/suppliers/limit/{id}",[SupplierController::class,"getSuppliers"]);
Route::get("/suppliers/products/{id}",[SupplierController::class,"getProducts"]);

Route::get('/all/category', [CategoryController::class, 'getAll'])->name('all.category');
//Product routes
Route::get("product/all",[ProductController::class,"getAllProducts"])->name("all.product");
Route::get("product/single/{id}",[ProductController::class,"getSingle"]);
Route::get("product/category/{id}",[ProductController::class,"getCategoryProducts"]);
Route::get("product/special_category/{id}",[ProductController::class,"getSpecialCategoryProducts"]);
Route::post("product/add",[ProductController::class,"store"]);
Route::post("product/update",[ProductController::class,"update"]);
Route::get("product/softdelete/{id}",[ProductController::class,"softDelete"]);
Route::get("product/restore/{id}",[ProductController::class,"restore"]);
Route::get("product/pdelete/{id}",[ProductController::class,"destroy"]);

