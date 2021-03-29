<?php

use Solital\Core\Course\Course;

/** Forgot Routers */
Course::get('/forgot', 'Auth\ForgotController@forgot')->name('forgot');
Course::post('/forgotPost', 'Auth\ForgotController@forgotPost')->name('forgotPost');
Course::get('/change/{hash}', 'Auth\ForgotController@change')->name('change');
Course::post('/changePost/{hash}', 'Auth\ForgotController@changePost')->name('changePost');