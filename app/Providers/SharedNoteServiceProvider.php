<?php

namespace App\Providers;

use App\Repositories\SharedNoteRepository\DbSharedNoteRepository;
use App\Repositories\SharedNoteRepository\ISharedNoteRepository;
use Illuminate\Support\ServiceProvider;

class SharedNoteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ISharedNoteRepository::class, function($app) {
            return new DbSharedNoteRepository();
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
