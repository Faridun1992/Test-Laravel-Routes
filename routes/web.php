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

// Task 1: point the main "/" URL to the HomeController method "index"
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);


// Task 2: point the GET URL "/user/[name]" to the UserController method "show"
// It doesn't use Route Model Binding, it expects $name as a parameter
Route::get('user/{name}', [\App\Http\Controllers\UserController::class, 'show']);


// Task 3: point the GET URL "/about" to the view
// resources/views/pages/about.blade.php - without any controller
// Also, assign the route name "about"
Route::get('about', function () {
    return view('pages.about');
})->name('about');


// Task 4: redirect the GET URL "log-in" to a URL "login"
Route::redirect('log-in', 'login');


// Task 5: group the following route sentences below in Route::group()
// Assign middleware "auth"
Route::middleware('auth')->group(function () {

    // Tasks inside that Authenticated group:

    // Task 6: /app group within a group
    // Add another group for routes with prefix "app"
    Route::prefix('app')->group(function () {


        // Tasks inside that /app group:


        // Task 7: point URL /app/dashboard to a "Single Action" DashboardController
        // Assign the route name "dashboard"
        Route::get('dashboard', \App\Http\Controllers\DashboardController::class)->name('dashboard');


        // Task 8: Manage tasks with URL /app/tasks/***.
        // Add ONE line to assign 7 resource routes to TaskController
        Route::resource('tasks', \App\Http\Controllers\TaskController::class);

        // End of the /app Route Group
    });

    // Task 9: /admin group within a group
    // Add a group for routes with URL prefix "admin"
    // Assign middleware called "is_admin" to them
    Route::prefix('admin')->middleware('is_admin')->group(function (){




    // Tasks inside that /admin group:


    // Task 10: point URL /admin/dashboard to a "Single Action" Admin/DashboardController
    Route::get('dashboard', \App\Http\Controllers\Admin\DashboardController::class);


    // Task 11: point URL /admin/stats to a "Single Action" Admin/StatsController
    Route::get('stats', \App\Http\Controllers\Admin\StatsController::class);


    // End of the /admin Route Group
    });
});

// One more task is in routes/api.php

require __DIR__ . '/auth.php';
