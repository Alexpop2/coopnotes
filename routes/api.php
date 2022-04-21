<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/users/{search?}',[\App\Http\Controllers\ApiUserController::class, 'showBySearch'])
        ->name('api.users.search');

    Route::get('/notes/{note}/users', [\App\Http\Controllers\ApiUserController::class, 'showBySharedNote'])
        ->name('api.notes.accessed_users');
    Route::delete(
        '/notes/{note}/users/{user}',
        [\App\Http\Controllers\ApiSharedNoteController::class, 'destroyByNoteAndUser']
    )
        ->name('api.notes.accessed_users.destroy');
    Route::post(
        '/notes/{note}/users/{user}',
        [\App\Http\Controllers\ApiSharedNoteController::class, 'store']
    )
        ->name('api.notes.accessed_users.store');

    Route::get('/notes/shared', [\App\Http\Controllers\ApiNoteController::class, 'showShared'])
        ->name('api.notes.shared.index');
    Route::apiResource("notes",\App\Http\Controllers\ApiNoteController::class)->names([
        'index' => 'api.notes.index'
    ])->only([
        'index'
    ]);

    Route::apiResource("notes.shared",\App\Http\Controllers\ApiSharedNoteController::class)->names([
        'store' => 'api.notes.shared.store',
        'update' => 'api.notes.shared.update',
        'destroy' => 'api.notes.shared.destroy',
        'edit' => 'api.notes.shared.edit'
    ])->only([
        'store', 'update', 'destroy', 'edit'
    ]);

    Route::middleware('can:view,note')->group(function () {
        Route::apiResource('notes', \App\Http\Controllers\ApiNoteController::class)->except([
            'store', 'index'
        ])->names([
            'show' => 'api.notes.show',
            'update' => 'api.notes.update',
            'destroy' => 'api.notes.destroy'
        ]);
    });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
