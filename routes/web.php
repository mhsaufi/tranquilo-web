<?php

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

Route::get('/',					'PublicController@index');
Route::get('/aboutus',			'PublicController@about');
Route::get('/contactus',		'PublicController@contact');
Route::get('/property',			'PublicController@property');
// Route::get('/',		'PublicController@index');

Auth::routes();

// Protected url redirection
Route::group(['middleware'=>'auth'],function(){

		Route::get('/home', 'HomeController@index')->name('home');

		Route::get('logout', 'SystemController@invalidate');

		Route::get('/addproperty',		'HomeController@addProperty');
		Route::post('/upload_gallery', 	'PropertyController@uploadGalleries');
		Route::post('/checkout',		'PropertyController@checkOutDeal');

		Route::post('/apply',			'ApplicationController@apply');

		Route::get('/viewmodel',		'PropertyController@viewProperty');
		Route::get('/viewmodelc',		'PropertyController@viewProperty');
		Route::get('/applyproperty',	'ApplicationController@applyProperty');
		Route::post('/rateproperty',	'PropertyController@rateProperty');
		Route::post('/bookmarkdeal',	'PropertyController@bookmarkDeal');

		Route::get('/mybookmark',		'HomeController@myBookmark');

		Route::get('/myapplication',	'ApplicationController@index');

		Route::get('/board',			'ApplicationController@boardLandlord');
		Route::get('/viewapplication',	'ApplicationController@viewApplication');
		
});


Route::get('galleries/{id}/{filename}', function ($id,$filename)
{
    return Storage::get('galleries/'.$id.'/'.$filename);
});