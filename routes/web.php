<?php

Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', 'HomeController@index')->name('home');
    
    Route::get('/folders/create', 'FolderController@showCreateForm')->name('folders.create');
    Route::post('/folders/create', 'FolderController@create');
    
    Route::group(['middleware' => 'can:view,folder'], function() {
        Route::get('/folders/{folder}/tasks', 'TaskController@index')->name('tasks.index');
        
        
        Route::get('/folders/{folder}/tasks/create', 'TaskController@showCreateForm')->name('tasks.create');
        Route::post('/folders/{folder}/tasks/create', 'TaskController@create');
        
        Route::get('/folders/{folder}/tasks/{task}/edit', 'TaskController@showEditForm')->name('tasks.edit');
        Route::post('/folders/{folder}/tasks/{task}/edit', 'TaskController@edit');  
        
        
        Route::get('/folders/{folder}/posts', 'PostsController@index')->name('posts.index');
        
        Route::get('/folders/{folder}/posts/create', 'PostsController@showCreateForm')->name('posts.create');
        Route::post('/folders/{folder}/posts/create', 'PostsController@create');
        
    });
    Route::get('/hello', 'UsereditController@index')->name('hello.index');
    Route::get('/folders/{folder}/posts/{post}/edit', 'PostsController@showEditForm')->name('posts.edit');
    Route::post('/folders/{folder}/posts/{post}/edit', 'PostsController@edit');  
});

Route::get('/', function () {
    return view('/welcome');
});

Auth::routes();