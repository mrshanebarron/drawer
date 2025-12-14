<?php

namespace MrShaneBarron\drawer\View\Components;

use Illuminate\View\Component;

class drawer extends Component
{
    public function __construct()
    {
        //
    }

    public function render()
    {
        return view('ld-drawer::components.drawer');
    }
}
