<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

    /**
     * Register services.
     *
     * @return void
     */
    public function register() {

        if (is_null($config = config('repositories'))) {

            return;
        }

        $driver       = $config['driver']       ?? null;
        $repositories = $config['repositories'] ?? null;

        if (!is_array($repositories) || !array_key_exists($driver, $repositories)) {

            return;
        }

        foreach ($repositories[$driver] as $interface => $concrete) {

            $this->app->bind($interface, $concrete);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() {

        //
    }
}
