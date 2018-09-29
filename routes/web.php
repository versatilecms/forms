<?php

/**
 * Admin Route/s
 */
Route::group([
    'as' => 'versatile.',
    'prefix' => 'admin/forms/',
    'middleware' => ['web', 'admin.user'],
    'namespace' => '\Versatile\Forms\Http\Controllers'
], function () {
    Versatile::resource('enquiries', 'EnquiryController');
    Versatile::resource('forms', 'FormController');
    Versatile::resource('inputs', 'InputController');
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
