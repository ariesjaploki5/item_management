<?php

use Illuminate\Http\Request;

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



Route::group(['middleware' => ['cors', 'api']], function() {
    Route::apiResources([

        'pmo_po' => 'PMO\PoController',

        'employee' => 'Api\EmployeeController',
        'department' => 'Api\DepartmentController',

        'country' => 'Api\CountryController',
        'brand' => 'Api\BrandController',
        'manufacturer' => 'Api\ManufacturerController',
        'packaging' => 'Api\PackagingController',

        'mode' => 'Api\ModeController',

        'category' => 'Api\CategoryController',
        'holiday' => 'Api\HolidayController',
        'item' => 'Api\ItemController',
        
        'supplier' => 'Api\SupplierController',
        'batch' => 'Api\BatchController',

        'purchase_order' => 'Api\PurchaseOrderController',
        'purchase_request' => 'Api\PurchaseRequestController',

        'ris' => 'Api\RisController',
        'iar' => 'Api\IarController',
        'dv' => 'Api\DvController',
        'inspection_officer' => 'Api\InspectionOfficerController',

        'fund_source' => 'Api\FundSourceController',


    ]);
    Route::post('check_supplier_if_exists', 'Api\SupplierController@check_supplier_if_exists');
    Route::post('check_item_if_exists', 'Api\ItemController@check_item_if_exists');

    Route::get('item_per_category/{id}', 'Api\ItemController@per_category');

    Route::put('accept_batch/{id}', 'Api\TransferController@accept_batch');

    Route::put('issue/{id}', 'Api\RisController@issued');
    Route::put('receive/{id}', 'Api\RisController@received');


    Route::post('search_po', 'Api\PurchaseOrderController@search_po');
    Route::post('search_pr', 'Api\PurchaseRequestController@search_pr');
    Route::post('search_dv', 'Api\DvController@search_dv');
    Route::post('search_iar', 'Api\IarController@search_iar');
    


    Route::get('get_user', 'AuthController@get_user');
    Route::post('logout', 'AuthController@logout');
    

});

Route::group(['middleware' => 'cors'], function () {

    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');

});



