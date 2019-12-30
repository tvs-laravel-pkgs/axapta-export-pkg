<?php
Route::group(['namespace' => 'Abs\AxaptaExportPkg\Api', 'middleware' => ['api']], function () {
	Route::group(['prefix' => 'axapta-export-pkg/api'], function () {
		Route::group(['middleware' => ['auth:api']], function () {
			// Route::get('taxes/get', 'TaxController@getTaxes');
		});
	});
});