<?php

namespace App\Providers;

use App\Interfaces\BaseInterface;
use App\Interfaces\ProductInterface;
use App\Interfaces\TwitterInterface;
use App\Repositories\BaseRepository;
use App\Repositories\ProductRepository;
use App\Repositories\TwitterRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TwitterInterface::class,TwitterRepository::class);
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
