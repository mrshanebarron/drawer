<?php

namespace MrShaneBarron\Drawer\Livewire;

use Livewire\Component;

class Drawer extends Component
{
    public bool $open = false;
    public string $position = 'right';
    public string $size = 'md';
    public bool $closeOnOverlay = true;
    public bool $closeOnEscape = true;
    public ?string $title = null;

    protected $listeners = ['openDrawer' => 'openDrawer', 'closeDrawer' => 'close'];

    public function mount(bool $open = false, string $position = 'right', string $size = 'md', bool $closeOnOverlay = true, bool $closeOnEscape = true, ?string $title = null): void
    {
        $this->open = $open;
        $this->position = $position;
        $this->size = $size;
        $this->closeOnOverlay = $closeOnOverlay;
        $this->closeOnEscape = $closeOnEscape;
        $this->title = $title;
    }

    public function openDrawer(): void { $this->open = true; }
    public function close(): void { $this->open = false; }
    public function toggle(): void { $this->open = !$this->open; }

    public function render()
    {
        return view('sb-drawer::livewire.drawer');
    }
}
