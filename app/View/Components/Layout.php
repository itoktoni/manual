<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Layout extends Component
{
    public $title;

    public function __construct($title = null)
    {
        $this->title = $title;
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        if(empty($this->title))
        {
            $this->title = env('APP_NAME', 'System Manual');
        }

        return view('layouts.template', [
            'title' => $this->title
        ]);
    }
}
