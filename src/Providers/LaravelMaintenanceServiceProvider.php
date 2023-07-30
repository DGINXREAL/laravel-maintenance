<?php

namespace DGINX\LaravelMaintenance\Providers;

use DGINX\LaravelMaintenance\Console\Commands\MaintenanceCommand;
use DGINX\LaravelMaintenance\Middlewares\MaintenanceMiddleware;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class LaravelMaintenanceServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot(Router $router, Kernel $kernel): void
    {
        if($this->app->runningInConsole()){
            $this->packagePublishes();
            $this->registerCommands();
        }
        $kernel->pushMiddleware(MaintenanceMiddleware::class);
    }

    protected function packagePublishes(): void
    {
        $this->publishes([
            __DIR__ . '/../../config/laravel-maintenance.php' => config_path('laravel_maintenance.php')
        ]);
    }

    protected function registerCommands(): void
    {
        $this->commands([
            MaintenanceCommand::class
        ]);
    }
}
