<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Upload extends Component
{
    public $name;

    public $id;

    public $label;

    public $hint;

    public $col;

    public $class;

    public $required;

    public $multiple;

    public $accept;

    public $maxSize;

    public $placeholder;

    public $value;

    public $attributes;

    public function __construct(
        $name = null,
        $id = null,
        $label = null,
        $hint = null,
        $col = 6,
        $class = 'form-input',
        $required = false,
        $multiple = false,
        $accept = null,
        $maxSize = null,
        $placeholder = 'Choose file...',
        $value = null,
        $attributes = []
    ) {
        $this->name = $name;
        $this->id = $id ?? $name;
        $this->label = $label ?? ucfirst(str_replace('_', ' ', $name));
        $this->hint = $hint;
        $this->col = $col;
        $this->class = $class;
        $this->required = $required;
        $this->multiple = $multiple;
        $this->accept = $accept;
        $this->maxSize = $maxSize;
        $this->placeholder = $placeholder;
        $this->value = $value ?? old($name);
        $this->attributes = $attributes;
    }

    public function render()
    {
        return view('components.upload');
    }
}