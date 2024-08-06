<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class button extends Component
{
    public $type;
    public $class;
    public $text;
    /**
     * Create a new component instance.
     */
    public function __construct($type='button', $class = 'px-10 py-2 rounded-lg bg-black text-white', $text = 'Submit')
    {
        $this->type = $type;
        $this->class = $class;
        $this->text = $text;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button');
    }
}
