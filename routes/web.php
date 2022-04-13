<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::middleware(\App\Http\Middleware\RedirectIfAuthenticated::class)->group(function () {
    Route::get('/', function () {
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    });
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::resource('notes', \App\Http\Controllers\NoteController::class)->only([
        'index', 'create'
    ]);
    Route::get('/notes/shared', [\App\Http\Controllers\NoteController::class, 'showShared'])
        ->name('notes.shared.index');
    Route::middleware('can:view,note')->group(function () {
        Route::resource('notes', \App\Http\Controllers\NoteController::class)->except([
            'store', 'index', 'create'
        ]);
    });
});


