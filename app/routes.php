<?php
// Login page
Route::get('/', 'MainController@index');
Route::post('/login', 'AuthController@login');
Route::get('/logout', 'AuthController@logout');

// Access-filter function
Route::filter('hasAccess', function($route, $request, $value1, $value2 = null) {
    if (Sentry::check()) {
        try {
            $user = Sentry::findUserById(1);
            if (!$user->hasAccess($value1) && !$user->hasAccess($value2))
                return Redirect::to('/')->withErrors(array(Lang::get('You have no access right on this page.')));
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            return Redirect::to('/')->withErrors(array(Lang::get('User not found')));
        }
    } else {
        return Redirect::to('/')->withErrors(array(Lang::get('Please log in with your credentials.')));
    }
});

Route::group(['before' => 'hasAccess:admin'], function() {
    Route::get('/dashboard', 'MainController@dashboard');
    Route::get('/users/getUsersData', 'UsersController@getUsersData');
    Route::resource('/users', 'UsersController');

    // Classes management
    Route::get('/classes/getClassesData', 'ClassesController@getClassesData');
    Route::resource('/classes', 'ClassesController');
});

Route::group(['before' => 'hasAccess:admin,admin.agenda'], function() {
    Route::get('/agenda/getAgendaData/{teacher_id}/{date}', 'AgendaController@getAgendaData');
    Route::resource('/agenda', 'AgendaController');
});

Route::group(['before' => 'hasAccess:admin,admin.attendance'], function() {
    Route::get('/attendance/student/{$student_id}', 'AttendanceController@showStudent');
    Route::resource('/attendance', 'AttendanceController');
});

Route::group(['before' => 'hasAccess:admin,admin.gallery'], function() {
    Route::resource('/album', 'AlbumsController');
    Route::resource('/gallery', 'GalleriesController');
});

Route::group(['before' => 'hasAccess:admin,admin.pinboard'], function() {
    Route::resource('/pinboard', 'PinboardController');
});

Route::group(['before' => 'hasAccess:admin,admin.grade'], function() {
    Route::get('/grade', 'MainController@grade');
});

Route::group(['before' => 'hasAccess:admin,admin.student'], function() {
    Route::get('/students/getMyStudents', 'StudentsController@getMyStudents');
    Route::resource('students', 'StudentsController');
});

Route::group(['before' => 'hasAccess:admin,admin.timeline'], function() {
    Route::resource('timeline', 'TimelineController');
});

Route::get('/account', 'MainController@account');
Route::get('/help', 'MainController@help');