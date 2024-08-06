<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class label extends Component
{
    public $for;
    public $text;
    public $class;
    /**
     * Create a new component instance.
     */
    public function __construct($for = '', $text = '', $class = 'font-sans font-semibold text-lg')
    {
        $this->for = $for;
        $this->text = $text;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.label');
    }
}
