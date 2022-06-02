<?php

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
Route::get("/users",[UserController::class,"getUsers"]);


Route::post('/supplier/register', [SupplierController::class, 'create'])->name('supplier.register');
Route::post('/update/supplierInfo', [SupplierController::class, 'updateInfo'])->name('supplier.info');
//Route::post('/update/adminPassword', [SupplierController::class, 'supplierPassword'])->name('supplier.supplierPassword');
Route::post('/update/supplierImage', [SupplierController::class, 'supplierImage'])->name('supplier.image');
Route::post('/supplier/login', [SupplierController::class, 'login'])->name('supplier.login');
Route::get("/suppliers",[SupplierController::class,"getSuppliers"]);
