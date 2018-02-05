<?php

Route::get('/', 'HomeController@index')->name('home');

Route::post('/image', 'ImageController@create')->name('image.create');
