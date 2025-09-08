<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/add_student', function () {
    return include(public_path('legacy/add_student.php'));
});

Route::get('/get_student', function () {
    return include(public_path('legacy/get_student.php'));
});

Route::get('/login', function () {
    return include(public_path('legacy/login.php'));
});

Route::get('/mark_attendance', function () {
    return include(public_path('legacy/mark_attendance.php'));
});

Route::get('/search_student', function () {
    return include(public_path('legacy/search_student.php'));
});

Route::get('/setpass', function () {
    return include(public_path('legacy/setpass.php'));
});

Route::get('/update_subject', function () {
    return include(public_path('legacy/update_subject.php'));
});

Route::get('/view_attendance', function () {
    return include(public_path('legacy/view_attendance.php'));
});
