<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormInput extends Component
{
    public $label;
    public $name;
    public $type;
    public $placeholder;
    public $col;

    public function __construct($label, $name, $type = 'text', $placeholder = '', $col = 'col-md-12')
    {
        $this->label = $label;
        $this->name = $name;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->col = $col;
    }

    public function render()
    {
        return view('components.form-input');
    }
}
