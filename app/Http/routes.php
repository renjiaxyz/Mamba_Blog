<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');

Route::get('/player', 'HomeController@player');

Route::get('/article/select', ['uses' => 'ArticleController@selectDate']);

Route::get('/article/{id}', ['as' => 'article', 'uses' => 'ArticleController@index']);

Route::get('/category/{id}', ['as' => 'category', 'uses' => 'CategoryController@index']);

Route::get('/tag/{id}', ['as' => 'tag', 'uses' => 'TagController@index']);

Route::get('/search', ['as' => 'search', 'uses' => 'SearchController@index']);

Route::get('/page/{alias}', ['as' => 'page.show', 'uses' => 'PageController@index']);

Route::get('/about',['as'=>'about','uses'=>'PageController@about']);

Route::get('/mail','ArticleController@mail');

Route::post('/comment',['as'=>'comment','uses'=>'CommentController@store']);

Route::get('/send',['as'=>'send','uses'=>'CommentController@send']);


Route::group(['prefix' => 'backend'], function () {

    Route::get('/login', 'Backend\AuthController@showLoginForm');

    Route::post('/login', 'Backend\AuthController@login');

    Route::get('/logout', 'Backend\AuthController@logout');

    Route::group(['middleware' => ['auth']], function () {

        Route::get('/', ['as' => 'backend.home', 'uses' => 'Backend\HomeController@index']);

        Route::get('mini-index', ['as' => 'backend.article.mini-index', 'uses' => 'Backend\ArticleController@miniIndex']);

        Route::get('mini-create', ['as' => 'backend.article.mini-create', 'uses' => 'Backend\ArticleController@miniArticleCreate']);

        Route::post('mini-store', ['as' => 'backend.article.mini-store', 'uses' => 'Backend\ArticleController@miniArticleStore']);

        Route::get('mini-edit/{id}', ['as' => 'backend.article.mini-edit', 'uses' => 'Backend\ArticleController@miniArticleEdit']);

        Route::post('mini-update/{id}',['as' => 'backend.article.mini-update','uses'=>'Backend\ArticleController@miniArticleUpdate']);

        Route::delete('mini-destroy/{id}',['as' => 'backend.article.mini-destroy','uses'=>'Backend\ArticleController@miniArticleDestroy']);

        Route::resource('article', 'Backend\ArticleController');

        Route::resource('comment','Backend\CommentController');

        Route::get('category-index', ['as' => 'backend.category.category-index', 'uses' => 'Backend\CategoryController@miniCategoryIndex']);

        Route::get('category-create', ['as' => 'backend.category.category-create', 'uses' => 'Backend\CategoryController@miniCategoryCreate']);

        Route::post('category-store', ['as' => 'backend.category.category-store', 'uses' => 'Backend\CategoryController@miniCategoryStore']);

        Route::get('category-edit/{id}', ['as' => 'backend.category.category-edit', 'uses' => 'Backend\CategoryController@miniCategoryEdit']);


        Route::resource('category', 'Backend\CategoryController');

        Route::get('category/set-nav/{id}', ['as' => 'backend.category.set-nav', 'uses' => 'Backend\CategoryController@setNavigation']);

        Route::resource('user', 'Backend\UserController');

        Route::resource('tag', 'Backend\TagController');

        Route::resource('link', 'Backend\LinkController');

        Route::resource('navigation', 'Backend\NavigationController');

        Route::get('upload', ['as' => 'backend.upload.index', 'uses' => 'Backend\UploadController@index']);

        Route::resource('page', 'Backend\PageController');

        Route::get('system', ['as' => 'backend.system.index', 'uses' => 'Backend\SystemController@index']);

        Route::post('system', ['as' => 'backend.system.store', 'uses' => 'Backend\SystemController@store']);

        Route::get('upload', ['as' => 'backend.upload.index', 'uses' => 'Backend\UploadController@index']);

        Route::delete('file-del', ['as' => 'backend.upload.file-del', 'uses' => 'Backend\UploadController@fileDelete']);

        Route::delete('dir-del', ['as' => 'backend.upload.dir-del', 'uses' => 'Backend\UploadController@dirDelete']);

        Route::post('mkdir', ['as' => 'backend.upload.mkdir', 'uses' => 'Backend\UploadController@makeDir']);

        Route::get('file-upload', ['as' => 'backend.upload.file-upload', 'uses' => 'Backend\UploadController@fileUpload']);

        Route::post('uploadimage',['uses'=>'Backend\UploadController@uploadimage']);

        Route::post('file-store', ['as' => 'backend.upload.file-store', 'uses' => 'Backend\UploadController@fileStore']);
    });
});
