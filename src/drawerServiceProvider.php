<?php

namespace MrShaneBarron\Drawer;

use Illuminate\Support\ServiceProvider;

class DrawerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if (class_exists(\Livewire\Livewire::class)) {
            \Livewire\Livewire::component('sb-drawer', Livewire\Drawer::class);
        }
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'sb-drawer');
    }
}
