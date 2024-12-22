<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NavTab extends Component
{
    public $label;
    public $target;
    public $isActive;

    public function __construct($label, $target, $isActive = false)
    {
        $this->label = $label;
        $this->target = $target;
        $this->isActive = $isActive;
    }

    public function render()
    {
        return view('components.profile.nav-tab');
    }
}
