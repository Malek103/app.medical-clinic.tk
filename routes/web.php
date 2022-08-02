<?php

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
Route::group(["middleware" => ["site"]], function() {

    Route::get('/login', "Login@loginPage");
    Route::post('/login', "Login@loginUser");

    Route::group(["middleware" => ["dashboard"]], function() {
        Route::get('/', "Home@index");

        Route::get('/users', "Users@index");
        Route::get('/users/create', "Users@create");
        Route::post('/users/create', "Users@store");
        Route::get('/users/{id}/edit', "Users@edit");
        Route::post('/users/update', "Users@update");
        Route::get('/users/{id}/delete', "Users@destroy");

        Route::get('/customers', "Customers@index");
        Route::get('/customers/create', "Customers@create");
        Route::post('/customers/create', "Customers@store");
        Route::get('/customers/{id}/edit', "Customers@edit");
        Route::post('/customers/update', "Customers@update");
        Route::get('/customers/{id}/delete', "Customers@destroy");
        Route::get('/customers/{id}/show', "Customers@show");
        Route::get('/customers/{id}/word-export', "Customers@wordExport");


        Route::get('/xrays', "Xrays@index");
        Route::get('/xrays/getxrays', "Xrays@getxrays");
        Route::get('/xrays/create', "Xrays@create");
        Route::post('/xrays/create', "Xrays@store");
        Route::get('/xrays/{id}/edit', "Xrays@edit");
        Route::post('/xrays/update', "Xrays@update");
        Route::get('/xrays/{id}/delete', "Xrays@destroy");
        Route::get('/xrays/reportXrays/{id}', "Xrays@xraysReport");

        Route::get('/medicines', "Medicines@index");
        Route::get('/medicines/getmedicines', "Medicines@getmedicines");
        Route::get('/medicines/create', "Medicines@create");
        Route::post('/medicines/create', "Medicines@store");
        Route::get('/medicines/{id}/edit', "Medicines@edit");
        Route::post('/medicines/update', "Medicines@update");
        Route::get('/medicines/{id}/delete', "Medicines@destroy");
        Route::get('/medicines/reportMedicines/{id}', "Medicines@MedicinesReport");



        Route::get('/examinations', "Examinations@index");
        Route::get("/examinations/getexamination", "Examinations@getexamination");
        Route::get('/examinations/create', "Examinations@create");
        Route::post('/examinations/create', "Examinations@store");
        Route::get('/examinations/{id}/edit', "Examinations@edit");
        Route::post('/examinations/update', "Examinations@update");
        Route::get('/examinations/{id}/delete', "Examinations@destroy");
        Route::get('/examinations/category/create', "Examinations@categoryCreate");
        Route::get('/examinations/category/index', "Examinations@categoryIndex");
        Route::post('/examinations/category/create', "Examinations@categoryStore");
        Route::get('/examinations/category/edit/{id}', "Examinations@categoryEdit");
        Route::post('/examinations/category/update/{id}', "Examinations@categoryUpdate");


        Route::get('/reservations', "Reservations@index");
        Route::get('/reservations/gettime/{date}', "Reservations@gettime");
        Route::get('/reservations/getexaminationdate/{mydate}', "Reservations@getexaminationdate");
        Route::get('/reservations/create', "Reservations@create");
        Route::post('/reservations/create', "Reservations@store");
        Route::get('/reservations/{id}/edit', "Reservations@edit");
        Route::post('/reservations/update', "Reservations@update");
        Route::get('/reservations/{id}/{date}/{time}/delete', "Reservations@delete");
        Route::get('/reservations/{id}/show', "Reservations@show");
        Route::post('/reservations/examinations/{id}/addNote', "Reservations@addNote");
        Route::get('/reservations/{id}/ready', "Reservations@ready");
        Route::get('/reservations/{id}/unready', "Reservations@unready");
        Route::get('/reservations/prescription/{id}', "Reservations@ReservationsReport");
        Route::get('/reservations/getinstructions/{id}', "Reservations@getinstructions");

        Route::post('/reservations/attachments/create/{id}', "AttachmentController@create");

        Route::post('/reservations/examinations/create', "Reservations@addExamination");
        Route::post('/reservations/examinations/update', "Reservations@updateExamination");
        Route::get('/reservations/examinations/{id}/delete', "Reservations@deleteExamination");

        Route::post('/reservations/xrays/create', "Reservations@addXRay");
        Route::post('/reservations/xrays/update', "Reservations@updateXRay");
        Route::get('/reservations/xrays/{id}/delete', "Reservations@deleteXRay");

        Route::post('/reservations/medicines/create', "Reservations@addMedicine");
        Route::get('/reservations/medicines/{id}/delete', "Reservations@deleteMedicine");

        Route::post('/reservations/payments/create', "Reservations@addPayment");
        Route::get('/reservations/payments/{id}/delete', "Reservations@deletePayment");

        Route::get('/reservations/calendar', "Reservations@calendar");
        Route::get('/reservations/{month}/getcalendar', "Reservations@getcalendar");

        Route::get('/accounting/payments', "Accounting@payments");
        Route::get('/accounting/expenses', "Accounting@expenses");
        Route::post('/accounting/expenses/create', "Accounting@storeExpense");
        Route::get('/accounting/transactions', "Accounting@transactions");

        Route::get('/language/switch', 'Users@switchLanguage');
        Route::get('/mode/switch', 'Users@switchMode');

        Route::get('/myaccount', "Users@myAccount");
        Route::post('/myaccount', "Users@updateCurrentUser");
        Route::get('/logout', "Users@logout");

        Route::get('/backups','DBBackup@index');
        Route::get('/backups/create', 'DBBackup@getBackup');
        Route::get('/backups/login', 'DBBackup@login');
        Route::post('/backups/login', 'DBBackup@checkLogin');
        Route::post('/backups/restore', 'DBBackup@restore');
        Route::get('/backup/download/{file_name}', 'DBBackup@download');



        Route::get('/getReadyList', 'ReadyListController@getReadyList');


        Route::get('/attachment/{id}','AttachmentController@index');
        Route::get('/file/{name}/{id}', 'AttachmentController@create');

    });

});

