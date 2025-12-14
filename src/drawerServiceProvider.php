<?php

namespace MrShaneBarron\drawer;

use Illuminate\Support\ServiceProvider;
use MrShaneBarron\drawer\Livewire\drawer;
use MrShaneBarron\drawer\View\Components\drawer as Bladedrawer;
use Livewire\Livewire;

class drawerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/ld-drawer.php', 'ld-drawer');
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'ld-drawer');

        Livewire::component('ld-drawer', drawer::class);

        $this->loadViewComponentsAs('ld', [
            Bladedrawer::class,
        ]);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/ld-drawer.php' => config_path('ld-drawer.php'),
            ], 'ld-drawer-config');

            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/ld-drawer'),
            ], 'ld-drawer-views');
        }
    }
}
