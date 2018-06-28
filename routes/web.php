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
 
Route::get('/', function () {
    return view('welcome');
});


Auth::routes();







Auth::routes();

Route::middleware(['auth','optimizeImages'])->group(function(){
Route::get('/home', 'FeedController@index')->name('home');

Route::post('/get-me-in', 'AfterSignup\AfterSignupController@createProfile')->name('get-me-in');
Route::get('/write','Article\ArticleController@create' )->name('write');
// For article controlling
Route::resource('article','Article\ArticleController');
Route::get('/feed', 'FeedController@index')->name('feed');
Route::get('/choosegenre', 'AfterSignup\AfterSignupController@chooseGenre')->name('choosegenre');

Route::post('/store-genre', 'AfterSignup\AfterSignupController@storeGenre')->name('store-genre');


Route::post('rem-genre', 'AfterSignup\AfterSignupController@remGenre')->name('rem-genre');
Route::post('NewProfile',function(){
    $view = view('AfterSignup.createprofile')->render();
    return response()->json(['view'=>$view]);
})->name('NewProfile');




// for following
Route::post('/follow','FollowController@follow')->name('follow');
Route::post('/unfollow','FollowController@unfollow')->name('unfollow');
Route::post('/like','FollowController@like')->name('like');
Route::post('/unlike','FollowController@unlike')->name('unlike');
Route::post('/bookmark','FollowController@bookmark')->name('bookmark');
Route::get('/show-bookmark','FollowController@showBookmark')->name('show-bookmark');
Route::post('/unmark','FollowController@unmark')->name('unmark');

// to save article
Route::post('/save','Article\ArticleController@save' )->name('save');

// to complete unfinished article 
Route::post('complete-article','Article\ArticleController@completeArticle')->name('complete-article');
// multi images for article
Route::post('/multi-image/{id}','Article\ArticleController@articleImage')->name('multi-image');

Route::get('/view-edit/{article}','Article\ArticleController@nonRealtimeEdit')->name('view-edit');
Route::post('/comment','Article\ArticleController@comment')->name('comment');

});


// To show article
Route::get('/show-article/{article}/{slug}','Article\ArticleController@show')->name('show-article');

// storries of a genre
Route::get('all-stories-in/{genre}','Article\ArticleController@sameGenreStories')->name('stories-genre');
// storries of a user
Route::get('all-stories-of/{user}','Article\ArticleController@sameUserStories')->name('stories-user');
//search
Route::get('/search','SearchController@search')->name('search');
Route::get('/search-item','SearchController@searchSuggestion')->name('search-item');
Route::get('/search-user','SearchController@searchUser')->name('search-user');
Route::get('/search-genre','SearchController@searchGenre')->name('search-genre');
Route::get('/profile/{user}/{slug}','ProfileController@show')->name('profile');
