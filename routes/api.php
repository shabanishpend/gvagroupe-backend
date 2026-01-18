<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/jobs', [App\Http\Controllers\Api\JobController::class, 'jobs']);
// Route::get('/projects', [App\Http\Controllers\ProjectController::class, 'projects']);
Route::middleware('api.key')->get('/testimonials', [App\Http\Controllers\TestimonialController::class, 'testimonials']);
Route::middleware('api.key')->get('/lasted-blogs', [App\Http\Controllers\BlogController::class, 'lastedBlogsApi']);
Route::middleware('api.key')->get('/blogs', [App\Http\Controllers\BlogController::class, 'blogsApi']);
Route::middleware('api.key')->get('/blog/{blog_id}', [App\Http\Controllers\BlogController::class, 'blogApi']);
// Route::get('/wlbs', [App\Http\Controllers\WorldLeadingBrandController::class, 'wlbs']);
// Route::post('/contact/send', [App\Http\Controllers\ContactController::class, 'contactSend']);

Route::post('/contact/send', [App\Http\Controllers\ContactController::class, 'contactSendApi']);
Route::post('/newsletter/submit', [App\Http\Controllers\NewsLetterController::class, 'store']);
Route::get('/buy/cars/models/{mark_id}', [App\Http\Controllers\BuyCarsController::class, 'modelsByMark']);
Route::post('/buy/cars/filter', [App\Http\Controllers\CarsController::class, 'filter']);

Route::post('/positions/facture/{id}', [App\Http\Controllers\FactureController::class, 'updatePositions']);
Route::post('/pay_date/update/{id}', [App\Http\Controllers\FactureController::class, 'updatePayedDate']);
Route::post('/payment_method_mode/update/{id}', [App\Http\Controllers\FactureController::class, 'updatePaymentMethodMode']);
Route::post('/shipping_method/update/{id}', [App\Http\Controllers\FactureController::class, 'updateShippingMethod']);
Route::post('/shipping_date/update/{id}', [App\Http\Controllers\FactureController::class, 'updateShippingDate']);