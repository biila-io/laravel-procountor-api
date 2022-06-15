<?php

namespace BiilaIo\Procountor;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class ProcountorServiceProvider extends ServiceProvider
{
    /**
     * {@inheritDoc}
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/procountor.php', 'procountor');

        $this->publishes([
            __DIR__ . '/../config/procountor.php' => $this->app->configPath('procountor.php'),
        ]);

        $this->app->bind(ProcountorConfig::class, function () {
            return new ProcountorConfig(
                $this->app['config']['services']['procountor'] ?? [],
                $this->app['config']['procountor'],
            );
        });

        $this->app->singleton(Procountor::class, function (Application $app) {
            return new Procountor($app->make(ProcountorConfig::class));
        });
    }
}
