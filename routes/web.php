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
Route::get('/pullnotificationnumber', 'SystemController@unreadCounter');
Route::get('/viewmodelp',		'PublicController@viewProperty');

Auth::routes();

// Protected url redirection
Route::group(['middleware'=>'auth'],function(){

		Route::get('/home', 			'HomeController@index')->name('home');
		Route::get('/profile',			'HomeController@profile');
		Route::post('/updateprofile',	'HomeController@updateProfile');
		Route::get('/profilepicture',	'HomeController@profilePicture');
		Route::post('/uploaddp',		'HomeController@newProfilePicture');
		Route::get('/passwordchange',function(){
			return view('passwordchange');
		});
		Route::post('/updatepassword',	'SystemController@updatepassword');

		Route::get('/message',			'HomeController@listMessages');
		Route::get('/readmail',			'HomeController@readMail');

		Route::get('logout', 'SystemController@invalidate');

		Route::get('/addproperty',		'HomeController@addProperty');
		Route::post('/upload_gallery', 	'PropertyController@uploadGalleries');
		Route::post('/checkout',		'PropertyController@checkOutDeal');
		Route::get('/feed',				'DealController@landlordFeed');

		Route::post('/apply',				'ApplicationController@apply');
		Route::post('/cancelapplication',	'ApplicationController@cancel');

		Route::get('/viewmodel',		'PropertyController@viewModel');
		Route::get('/viewmodelc',		'PropertyController@viewProperty');
		Route::get('/viewmodelland',	'PropertyController@viewPropertyLandlord');
		Route::get('/applyproperty',	'ApplicationController@applyProperty');
		Route::get('/apply',			'ApplicationController@applyPropertyLandlord');
		Route::post('/rateproperty',	'PropertyController@rateProperty');
		Route::post('/bookmarkdeal',	'PropertyController@bookmarkDeal');

		Route::get('/mybookmark',		'HomeController@myBookmark');

		Route::get('/myapplication',	'ApplicationController@index');

		Route::get('/board',			'ApplicationController@boardLandlord');
		Route::get('/viewapplication',	'ApplicationController@viewApplication');
		Route::get('/dealboard',		'DealController@viewDeal');
		Route::get('/viewdeal',			'DealController@viewSingleDeal');
		Route::get('/adddeal',			'DealController@newDeal');
		Route::post('/postdeal',		'DealController@addNewDeal');

		Route::get('/editproperty',		'PropertyController@editProperty');
		Route::post('/newgallery',		'PropertyController@uploadGalleriesEdit');
		Route::post('/updateproperty',	'PropertyController@updateProperty');

		Route::post('/reject',			'ApplicationController@rejectApplication');
		Route::post('/accept',			'ApplicationController@acceptApplication');
		Route::post('/review',			'ApplicationController@reviewApplication');
		Route::post('/postreview',		'DealController@addReview');

		Route::get('/editdeal',			'DealController@editDeal');
		Route::post('/updatedeal',		'DealController@editDealSave');
		Route::post('/deletedeal',		'DealController@deleteDeal');

		Route::get('/applylandlord', function(){

			return view('landlordapply');

		});

		Route::get('/termandcondition',	function(){
			return view('auth.termncondition');
		});

		Route::post('/applying',	'SystemController@applyLandlord');

		Route::get('/deactivate',	'SystemController@deactivation');
		Route::get('/deactivating',	'SystemController@deactivating');

});


Route::get('galleries/{id}/{filename}', function ($id,$filename)
{
    return Storage::get('galleries/'.$id.'/'.$filename);
});

Route::get('avatar/{id}/{filename}', function ($id,$filename)
{
    return Storage::get('users/'.$id.'/'.$filename);
});

// Admin Section

Route::get('/admin',			'AdminController@index');
Route::get('/administrator',	'AdminController@register');
Route::post('loginadmin',		'Auth\AdminLoginController@authenticate');
Route::post('registeradmin', 	'Auth\AdminRegisterController@register');

Route::group(['middleware'=>'auth'],function(){

	Route::get('/dashboard',	'AdminController@home');
	Route::get('/permission',	'AdminController@permission');
	Route::post('/approvelandlordapply',	'AdminController@approveLandlord');

});