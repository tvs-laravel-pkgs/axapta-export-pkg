<?php

Route::group(['namespace' => 'Abs\AxaptaExportPkg', 'middleware' => ['web', 'auth'], 'prefix' => 'axapta-export-pkg'], function () {
	Route::get('/axapta-exports/get-list', 'AxaptaExportController@getAxaptaExportList')->name('getAxaptaExportList');
	Route::get('/axapta-export/get-form-data/{id?}', 'AxaptaExportController@getAxaptaExportFormData')->name('getAxaptaExportFormData');
	Route::post('/axapta-export/save', 'AxaptaExportController@saveAxaptaExport')->name('saveAxaptaExport');
	Route::get('/axapta-export/delete/{id}', 'AxaptaExportController@deleteAxaptaExport')->name('deleteAxaptaExport');

});