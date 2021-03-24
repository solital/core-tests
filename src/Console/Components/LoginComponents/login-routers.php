/** Login Routers */
Course::get('/login', 'Auth\LoginController@login')->name('login');
Course::post('/verify-login', 'Auth\LoginController@verify')->name('verifyLogin');
Course::get('/dashboard', 'Auth\LoginController@dashboard')->name('dashboard');
Course::get('/logoff', 'Auth\LoginController@exit')->name('exit');