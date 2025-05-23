<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Api\CartApiController;
use App\Http\Controllers\Api\ProductApiController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();  
// });

// Route::post('/artCartlogin', function (Request $request) {
//     $user = User::where('email', $request->email)->first();

//     if ($user && Hash::check($request->password, $user->password)) {
//         $token = $user->createToken('ArtCart')->plainTextToken;

//         return response()->json([
//             'token' => $token,
//             'redirect_to' => url('/frontend/products'), 
//         ]);
//     }

//     return response()->json(['message' => 'Unauthorized'], 401);
// });

Route::post('/frontend/products', function (Request $request) {
        return redirect('/frontend/products');
});

Route::get('/cart/create-order', [CartApiController::class, 'createOrder']);
Route::post('/cart/payment', [CartApiController::class, 'storePayment']);
// Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('products', ProductApiController::class);
    Route::prefix('cart')->group(function () {
        Route::post('/add', [CartApiController::class, 'addToCart']);
        Route::put('/item/{id}', [CartApiController::class, 'updateCartItem']);
        Route::delete('/item/{id}', [CartApiController::class, 'removeCartItem']);
        Route::get('/', [CartApiController::class, 'viewCart']);
      

    });
// });
Route::post('/cart/payment', [OrderController::class, 'storeAfterPayment']);
Route::post('/cart/payment', [CartApiController::class, 'verifyPayment']);
