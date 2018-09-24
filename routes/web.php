<?php

/**
 * Admin Route/s
 */
Route::group([
    'as' => 'versatile.forms.',
    'prefix' => 'admin/forms/',
    'middleware' => ['web', 'admin.user'],
    'namespace' => '\Versatile\Forms\Http\Controllers'
], function () {
    Route::post('order', ['uses' => "InputController@order", 'as' => 'order']);
});

/**
 * Front-end Route/s
 */
Route::group([
    'as' => 'versatile.enquiries.',
    'middleware' => ['web'],
    'namespace' => '\Versatile\Forms\Http\Controllers'
], function () {
    Route::post('versatile-forms-submit-enquiry/{id}', ['uses' => "EnquiryController@submit", 'as' => 'submit']);
});
