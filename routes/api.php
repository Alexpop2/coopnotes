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
