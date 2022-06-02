<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;


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


Route::post('drivers/login', [ApiController::class, 'driverlogin'])->name('driver.login');
Route::get('login', [ApiController::class, 'login'])->name('login');

Route::post('drivers/logout', [ApiController::class,'driverlogout'])->middleware('assign.guard:drivers-api');
Route::get('drivers/myInfo', [ApiController::class,'driverInfo'])->middleware('assign.guard:drivers-api');
Route::post('drivers/updateDriverInfo', [ApiController::class,'updateDriverInfo'])->middleware('assign.guard:drivers-api');

//Collector Api's
Route::get('collector/CollectorOrdersHome', [ApiController::class,'CollectorOrdersHome'])->middleware('assign.guard:drivers-api');
Route::post('collector/CollectorOrdersByRestaurants', [ApiController::class,'CollectorOrdersByRestaurants'])->middleware('assign.guard:drivers-api');
Route::post('collector/CollectorOrdersByRestaurantsSearchByCustomer', [ApiController::class,'CollectedOrdersByRestaurantsSearchByCustomer'])->middleware('assign.guard:drivers-api');
Route::post('collector/CollectorRestaurantslocationInfo', [ApiController::class,'CollectorRestaurantLocationInfo'])->middleware('assign.guard:drivers-api');
Route::post('collector/UpdateCollectedOrderStatus', [ApiController::class,'UpdateCollectedOrderStatus'])->middleware('assign.guard:drivers-api');
Route::post('collector/returnCash', [ApiController::class,'returnCash'])->middleware('assign.guard:drivers-api');

Route::post('collector/collectorRestaurantChat', [ApiController::class,'CollectorRestaurantChat'])->middleware('assign.guard:drivers-api');
Route::post('collector/collectorRestaurantSend', [ApiController::class,'CollectorRestaurantSend'])->middleware('assign.guard:drivers-api');

//Driver API's
Route::get('driver/DriverHomeDeliveries', [ApiController::class,'DriverHomeDeliveries'])->middleware('assign.guard:drivers-api');
Route::get('driver/DriverHomeOrders', [ApiController::class,'DriverHomeOrders'])->middleware('assign.guard:drivers-api');
Route::get('driver/DriverHomeOrdersDeliverd', [ApiController::class,'DriverHomeOrdersDeliverd'])->middleware('assign.guard:drivers-api');
Route::get('driver/DriverHomeOrdersReceived', [ApiController::class,'DriverHomeOrdersReceived'])->middleware('assign.guard:drivers-api');
Route::post('driver/DriverHomeDeliveriesByRestaurant', [ApiController::class,'DriverHomeDeliveriesByRestaurant'])->middleware('assign.guard:drivers-api');
Route::post('driver/DriverHomeDeliveriesByDistricts', [ApiController::class,'DriverHomeDeliverisByDistrict'])->middleware('assign.guard:drivers-api');

Route::post('driver/updateDeliveryStatus', [ApiController::class,'DriverUpdateDeliveryStatus'])->middleware('assign.guard:drivers-api');
Route::post('driver/uploadDeliveryPic', [ApiController::class,'uploadDeliveryPic'])->middleware('assign.guard:drivers-api');

Route::post('driver/updateOrderStatus', [ApiController::class,'DriverUpdateOrderStatus'])->middleware('assign.guard:drivers-api');

Route::post('driver/driverCustomerChat', [ApiController::class,'DriverCustomerChat'])->middleware('assign.guard:drivers-api');
Route::post('driver/driverCustomerSend', [ApiController::class,'DriverCustomerSend'])->middleware('assign.guard:drivers-api');



//customer API's

Route::post('customer/login', [ApiController::class, 'CustomerLogin'])->name('customer.login');

Route::get('customer/home', [ApiController::class,'CustomerHome'])->middleware('assign.guard:customers-api');

Route::get('customer/allDeliveris', [ApiController::class,'AllDeliveries'])->middleware('assign.guard:customers-api');

Route::get('customer/comingDeliveris', [ApiController::class,'ComingDeliveries'])->middleware('assign.guard:customers-api');

Route::get('customer/profile', [ApiController::class,'CustomerProfile'])->middleware('assign.guard:customers-api');

Route::post('customer/updateProfile', [ApiController::class,'updateProfile'])->middleware('assign.guard:customers-api');

Route::get('customer/myRestaurant', [ApiController::class,'myRestaurant'])->middleware('assign.guard:customers-api');

Route::get('customer/ads', [ApiController::class,'ads'])->middleware('assign.guard:customers-api');

Route::post('customer/freez', [ApiController::class,'freez'])->middleware('assign.guard:customers-api');

Route::post('customer/renew', [ApiController::class,'renew'])->middleware('assign.guard:customers-api');

Route::post('customer/logout', [ApiController::class,'customerLogout'])->middleware('assign.guard:drivers-api');

Route::post('customer/updateLocation', [ApiController::class,'updateLocation'])->middleware('assign.guard:customers-api');

Route::post('customer/customerDriverChat', [ApiController::class,'customerDriverChat'])->middleware('assign.guard:customers-api');

Route::post('customer/customerDriverSend', [ApiController::class,'customerDriverSend'])->middleware('assign.guard:customers-api');

Route::get('customer/customerPartnerChat', [ApiController::class,'customerPartnerChat'])->middleware('assign.guard:customers-api');

Route::post('customer/customerPartnerSend', [ApiController::class,'customerPartnerSend'])->middleware('assign.guard:customers-api');


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
