<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductListController;
use App\Http\Controllers\Admin\VisitorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

////////////USER LOGIN API///////////////////

Route::post('/login', [AuthController::class, 'Login']);

Route::post('/register', [AuthController::class, 'Register']);

Route::get('/user', [UserController::class, 'User'])->middleware("auth:api");


////////////END USER LOGIN API//////////////



Route::get('/getvisitor', [VisitorController::class, 'GetVisitorDetails']);

Route::get('/getAllCategories', [CategoryController::class, 'GetAllCategories']);

Route::get('/getCategoriesById/{id}', [CategoryController::class, 'GetCategoriesById']);

Route::get('/getProductsById/{id}', [ProductListController::class, 'GetProductsById']);

Route::get('/getProductsByCategory/{id}', [ProductListController::class, 'GetProductListByCategory']);

Route::get('/getAllSubcategories', [CategoryController::class, 'GetAllSubcategories']);

Route::get('/getProductListByRemarks/{remarks}', [ProductListController::class, 'GetProductListByRemarks']);

// for search
Route::get('/search/{search_term}', [ProductListController::class, 'SearchProduct']);

// for suggestion
Route::get('/suggest/{subcategory}', [ProductListController::class, 'SimilarProducts']);

// Product Cart Route
Route::post('/addtocart', [ProductCartController::class, 'addToCart']);

// Cart Count Route
Route::get('/cartcount/{email}', [ProductCartController::class, 'CartCount']);

// Cart List Route 
Route::get('/cartlist/{email}', [ProductCartController::class, 'CartList']);

Route::get('/removecartlist/{id}', [ProductCartController::class, 'RemoveCartList']);

Route::get('/cartitemplus/{id}/{quantity}/{price}', [ProductCartController::class, 'CartItemPlus']);

Route::get('/cartitemminus/{id}/{quantity}/{price}', [ProductCartController::class, 'CartItemMinus']);


// Cart Order Route
Route::post('/cartorder', [ProductCartController::class, 'CartOrder']);

Route::get('/orderlistbyuser/{email}', [ProductCartController::class, 'OrderListByUser']);

// Post Product Review Route
Route::post('/postreview', [ReviewController::class, 'PostReview']);

// Review Product Route
Route::get('/reviewlist/{product_code}', [ReviewController::class, 'ReviewList']);
