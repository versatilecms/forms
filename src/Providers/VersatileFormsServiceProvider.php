<?php

namespace Versatile\Forms\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Versatile\Forms\Forms;
use Versatile\Forms\Commands;
use Versatile\Forms\Facades\Forms as FormsFacade;

class VersatileFormsServiceProvider extends ServiceProvider
{
    /**
     * Our root directory for this package to make traversal easier
     */
    protected $packagePath = __DIR__ . '/../../';

    /**
     * Bootstrap the application services
     *
     * @return void
     */
    public function boot()
    {
        $this->strapRoutes();
        $this->strapViews();
        $this->strapHelpers();
        $this->strapMigrations();
        $this->strapCommands();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom($this->packagePath . 'config/versatile-forms.php', 'versatile-forms');

        if ($this->app->runningInConsole()) {
            $this->strapPublishers();
        }
    }

    /**
     * Register the publishable files.
     */
    private function strapPublishers()
    {
        $publishable = [
            'config' => [
                $this->packagePath . 'config/versatile-forms.php' => config_path('versatile-forms.php'),
            ]
        ];

        foreach ($publishable as $group => $paths) {
            $this->publishes($paths, $group);
        }
    }

    /**
     * Bootstrap our Routes
     */
    protected function strapRoutes()
    {
        $this->loadRoutesFrom($this->packagePath . 'routes/web.php');
    }

    /**
     * Bootstrap our Views
     */
    protected function strapViews()
    {
        $this->loadViewsFrom($this->packagePath . 'resources/views', 'versatile-forms');
        $this->loadViewsFrom($this->packagePath . 'resources/views/vendor/versatile', 'versatile');
    }

    /**
     * Load helpers.
     */
    protected function strapHelpers()
    {
        foreach (glob($this->packagePath . '/src/Helpers/*.php') as $filename) {
            require_once $filename;
        }
    }

    /**
     * Bootstrap our Migrations
     */
    protected function strapMigrations()
    {
        // Load migrations
        $this->loadMigrationsFrom($this->packagePath . 'database/migrations');

        // Locate our factories for testing
        $this->app->make('Illuminate\Database\Eloquent\Factory')->load(
            $this->packagePath . 'database/factories'
        );
    }

    /**
     * Bootstrap our Commands/Schedules
     */
    protected function strapCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Commands\InstallCommand::class
            ]);
        }
    }
}
