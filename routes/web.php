<?php

use Illuminate\Support\Facades\Route;

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

/*
* Basic search routes
*/
Route::get('/', 'indexController@search')->name('home');
Route::get('/search', 'indexController@search')->name('search');
Route::match(array('GET','POST'),'/search/results/', 'indexController@results')->name('results');;

/*
* Spelunker route for all records
*/
Route::get('/spelunker', 'indexController@index')->name('spelunker');

/*
* Object based routes
*/
Route::get('/id/object/{priref}', 'indexController@record')->name('record');
Route::get('/id/object/{priref}/{format}', 'indexController@recordSwitch')->name('record.context');
Route::get('/id/image/{id}/', 'indexController@image')->name('image.single');
Route::get('/id/image/3d/{id}/', 'indexController@sketchfab')->name('sketchfab');
Route::get('/id/image/iiif/{id}/', 'indexController@iiif')->name('image.iiif');
Route::get('/id/image/slow/iiif/', 'indexController@slowiiif')->name('slow.iiif');


Route::match(array('GET','POST'),'/images/id/{priref}/', 'indexController@images')->name('images.multiple');

/*
* Publication routes
*/
Route::get('/id/publication/{id}', 'publicationsController@record')->name('publication.record');
Route::get('/id/publication/{id}/{format}', 'publicationsController@recordSwitch')->name('publication.context');

/*
* Publication routes
*/
Route::get('/id/exhibition/{id}', 'exhibitionsController@exhibition')->name('exhibition.record');
Route::get('/id/exhibition/{id}/{format}', 'exhibitionsController@recordSwitch')->name('exhibition.context');


/*
* Terminology routes
*/
Route::get('/id/terminology/{id}', 'terminologyController@record')->name('terminology');
Route::get('/id/terminology/{id}/{format}', 'terminologyController@recordSwitch')->name('terminology.switch');

/*
*  Agent based routes
*/
Route::get('/id/agent/{id}', 'agentsController@record')->name('agent');
Route::get('/id/agent/{id}/{format}', 'agentsController@recordSwitch')->name('agent.switch');

/*
* Department page
*/
Route::get('/id/departments/{id}', 'departmentsController@record')->name('department');

/*
* Cache clear route
*/
Route::get('/clear-cache', [
    'as' => 'cache-clear',
    'uses' => 'Controller@clearCache'
])->middleware('auth.very_basic', 'doNotCacheResponse');
