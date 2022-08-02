<?php

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

Route::group([],function() {

    Route::post('login', "API\Authentication@login");

    Route::group(["middleware" => ["auth:api"]], function() {


        Route::get("/auth/user", 'API\UserController@getCurrentUserInfo');
        Route::post("/auth/user/update", 'API\UserController@updateCurrentUser');


        /* ######### Users Routes ############## */
        Route::get("/users", 'API\UserController@getAllUsers');
        Route::post("/users/create", 'API\UserController@storeUser');
        Route::post("/users/update", 'API\UserController@updateUser');        
        Route::delete("/users/{id}/delete", 'API\UserController@deleteUser');    
        
        
        /* ########## Customer Routes ############ */
        Route::get("/customers", 'API\CustomersController@index');
        Route::post("/customers/create", 'API\CustomersController@store');
        Route::post("/customers/update", 'API\CustomersController@update');
        Route::delete("/customers/{id}/delete", 'API\CustomersController@delete');

        /* ######## Medicines Routes ############# */
        Route::get("/medicines", 'API\MedicinesController@index');
        Route::post("/medicines/create", 'API\MedicinesController@store');
        Route::post("/medicines/update", 'API\MedicinesController@update');
        Route::delete("/medicines/{id}/delete", 'API\MedicinesController@delete');

        /* ######## Medical Examination Routes ############# */
        Route::get("/examinations", 'API\ExaminationsController@index');
        Route::get("/examinations/getexamination", 'API\ExaminationsController@getexamination');
        Route::post("/examinations/create", 'API\ExaminationsController@store');
        Route::post("/examinations/update", 'API\ExaminationsController@update');
        Route::delete("/examinations/{id}/delete", 'API\ExaminationsController@delete'); 
        
        /* ######## X-Rays Routes ############# */
        Route::get("/xrays", 'API\XRaysController@index');
        Route::post("/xrays/create", 'API\XRaysController@store');
        Route::post("/xrays/update", 'API\XRaysController@update');
        Route::delete("/xrays/{id}/delete", 'API\XRaysController@delete');   
        
        /* ######## Reservations API ########### */
        Route::get("/reservations", 'API\ReservationsController@index');
        Route::get("/reservations/currentmonth", 'API\ReservationsController@currentMonthReservations');
        Route::get("/reservations/filter", 'API\ReservationsController@filterReservations');
        Route::get("/reservations/{id}/show", 'API\ReservationsController@showSingleReservation');
        Route::post("/reservations/create", 'API\ReservationsController@store');
        Route::post("/reservations/update", 'API\ReservationsController@update');
        Route::delete("/reservations/{id}/delete", 'API\ReservationsController@delete');  
        
        Route::post("/reservations/examination/add", 'API\ReservationsController@addExamination');
        Route::post("/reservations/examination/update", 'API\ReservationsController@updateExamination');
        Route::delete("/reservations/examination/{id}/delete", 'API\ReservationsController@deleteExamination');

        Route::post("/reservations/xray/add", 'API\ReservationsController@addXRay');
        Route::post("/reservations/xray/update", 'API\ReservationsController@updateXRay');
        Route::delete("/reservations/xray/{id}/delete", 'API\ReservationsController@deleteXRay');

        Route::post("/reservations/medicine/add", 'API\ReservationsController@addMedicine');
        Route::delete("/reservations/medicine/{id}/delete", 'API\ReservationsController@deleteMedicine');

        Route::post("/reservations/payments/add", 'API\ReservationsController@addPayment');
        Route::delete("/reservations/payments/{id}/delete", 'API\ReservationsController@deletePayment');


        Route::post("/database/backup/create", 'API\DBBackup@createBackup');
        Route::post("/database/backup/import", 'API\DBBackup@importBackup');
       
    });

});


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
