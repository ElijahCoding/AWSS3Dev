<?php

Route::get('/', 'HomeController@index')->name('home');

Route::get('/{name}', 'ImageController@index')->name('image.index');
Route::post('/image', 'ImageController@create')->name('image.create');
