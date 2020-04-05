<?php

Route::post('/login', 'Auth\LoginController');
Route::post('/register', 'Auth\RegisterController');
Route::post('/logout', 'Auth\LogoutController');
