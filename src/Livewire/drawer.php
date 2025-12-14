<?php

namespace MrShaneBarron\Drawer\Livewire;

use Livewire\Component;

class Drawer extends Component
{
    public bool $open = false;
    public string $position = 'right';
    public string $size = 'md';
    public string $title = '';
    public bool $overlay = true;
    public bool $closeOnEscape = true;
    public bool $closeOnOverlay = true;

    public function mount(
        bool $open = false,
        string $position = 'right',
        string $size = 'md',
        string $title = '',
        bool $overlay = true,
        bool $closeOnEscape = true,
        bool $closeOnOverlay = true
    ): void {
        $this->open = $open;
        $this->position = $position;
        $this->size = $size;
        $this->title = $title;
        $this->overlay = $overlay;
        $this->closeOnEscape = $closeOnEscape;
        $this->closeOnOverlay = $closeOnOverlay;
    }

    public function close(): void
    {
        $this->open = false;
        $this->dispatch('drawer-closed');
    }

    public function render()
    {
        return view('ld-drawer::livewire.drawer');
    }
}
