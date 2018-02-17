<?php

$stripe = resolve('App\Billing\Stripe');

route::get('/', 'PostsController@index')->name('home');
route::get('/posts/create', 'PostsController@create');
route::post('/posts', 'PostsController@store');
route::get('/posts/{post}', 'PostsController@show');
route::post('/posts/{post}/comments', 'CommentsController@store');

route::post('reply/create/{comment}', 'CommentsController@addReplyComment')->name('replyComment.store');

Route::resource('comment', 'CommentsController', ['only'=>['update', 'destroy']]);

route::get('/posts/tags/{tag}', 'TagsController@index');

route::get('/register', 'RegistrationController@create');
route::post('/register', 'RegistrationController@store');

route::get('/login', 'SessionsController@create');
route::post('/login', 'SessionsController@store');
route::get('/logout', 'SessionsController@destroy');