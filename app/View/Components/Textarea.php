<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Textarea extends Component
{
    public $name;
    public $label;
    public $id;
    public $rows;
    public $class;
    public $placeholder;
    public $value;
    public $error;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $name,
        $label = null,
        $id = null,
        $rows = 3,
        $class = null,
        $placeholder = null,
        $value = null,
        $error = null
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->id = $id;
        $this->rows = $rows;
        $this->class = $class;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->error = $error;
    }

    /**
     * Get the view for the component.
     */
    public function render()
    {
        return view('components.textarea');
    }
}
