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



Route::group(['middleware' => ['api', 'cors']], function() {
    Route::apiResources([

        'pmo_po' => 'PMO\PoController',
        'pmo_iar' => 'PMO\IarController',
        'pmo_ris' => 'PMO\RisController',

        'approving_officer' => 'Api\ApprovingOfficerController',

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

        'user' => 'Api\UserController',
    ]);

    Route::get('hcharge', 'Homis\HchargeController@index');

    Route::get('riss_by_category/{category_id}', 'Api\RisController@riss_by_category');

    Route::post('store_ofs_ris', 'Api\RisController@store_ofs_ris');
    Route::put('update_ofs_ris/{control_no}', 'Api\RisController@update_ofs_ris');

    Route::post('store_os_ris', 'Api\RisController@store_os_ris');
    Route::put('update_os_ris/{control_no}', 'Api\RisController@update_os_ris');

    Route::get('item_drugs_and_medicines', 'Api\ItemController@item_drugs_and_medicines');
    Route::get('drugs_and_medicines', 'Api\ItemController@drugs_and_medicines');
    Route::get('drugs_and_medicines/{search_word}', 'Api\ItemController@drugs_and_medicines_search');

    Route::get('item_medical_supplies', 'Api\ItemController@item_medical_supplies');
    Route::get('medical_supplies', 'Api\ItemController@medical_supplies');
    Route::get('medical_supplies/{search_word}', 'Api\ItemController@medical_supplies_search');

    Route::get('item_office_supplies', 'Api\ItemController@item_office_supplies');
    Route::get('office_supplies', 'Api\ItemController@office_supplies');
    Route::get('office_supplies/{search_word}', 'Api\ItemController@office_supplies_search');

    Route::get('item_other_supplies', 'Api\ItemController@item_other_supplies');
    Route::get('other_supplies', 'Api\ItemController@other_supplies');
    Route::get('other_supplies/{search_word}', 'Api\ItemController@other_supplies_search');

    Route::put('stock/{id}', 'Api\StockController@update');
    Route::put('update_beginning_balance/{id}', 'Api\StockController@update_beginning_balance');
    
    Route::get('pmo_search_batch/{search_word}', 'PMO\BatchController@search_batch');

    Route::put('pmo_ris_receive/{id}', 'PMO\RisController@received');
    Route::put('pmo_ris_issue/{id}', 'PMO\RisController@issued');
    Route::get('search_batch/{search_word}', 'Api\BatchController@search_batch');
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
    
    Route::get('search_user/{search_word}', 'Api\UserController@search_user');

    Route::get('get_user', 'AuthController@get_user');
    Route::post('logout', 'AuthController@logout');
    

});

Route::group(['middleware' => 'cors'], function () {

    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');

});



