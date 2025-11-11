<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Report extends Component
{
    public $title;
    public $print;

    public function __construct($title = null, $print = 'report')
    {
        $this->title = $title;
        $this->print = $print;
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.print', [
            'print' => $this->print
        ]);
    }
}
