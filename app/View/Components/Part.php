<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Part extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $parts;
    public $makeCol = 0;
    public $fav = 1;
    public function __construct($parts,$makeCol)
    {
        $this->parts = $parts;
        $this->makeCol = $makeCol;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.part');
    }
}
