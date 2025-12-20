<?php

namespace MrShaneBarron\Drawer\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class Drawer extends Component
{
    public bool $open = false;
    public string $position = 'right';
    public string $size = 'md';
    public bool $closeOnOverlay = true;
    public bool $closeOnEscape = true;
    public ?string $title = null;
    public ?string $drawerId = null;
    public string $content = '';

    public function mount(
        bool $open = false,
        string $position = 'right',
        string $size = 'md',
        bool $closeOnOverlay = true,
        bool $closeOnEscape = true,
        ?string $title = null,
        ?string $drawerId = null,
        string $content = ''
    ): void {
        $this->open = $open;
        $this->position = $position;
        $this->size = $size;
        $this->closeOnOverlay = $closeOnOverlay;
        $this->closeOnEscape = $closeOnEscape;
        $this->title = $title;
        $this->drawerId = $drawerId;
        $this->content = $content;
    }

    #[On('open-drawer')]
    public function openDrawer(?string $id = null): void
    {
        if ($id === null || $id === $this->drawerId) {
            $this->open = true;
        }
    }

    #[On('close-drawer')]
    public function closeDrawer(?string $id = null): void
    {
        if ($id === null || $id === $this->drawerId) {
            $this->open = false;
        }
    }

    public function close(): void
    {
        $this->open = false;
    }

    public function toggle(): void
    {
        $this->open = !$this->open;
    }

    public function render()
    {
        return view('sb-drawer::livewire.drawer');
    }
}
