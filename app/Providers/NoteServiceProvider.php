<?php

namespace App\Providers;

use App\Repositories\NoteRepository\DbNoteRepository;
use App\Repositories\NoteRepository\INoteRepository;
use Illuminate\Support\ServiceProvider;

class NoteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(INoteRepository::class, function($app) {
            return new DbNoteRepository();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
