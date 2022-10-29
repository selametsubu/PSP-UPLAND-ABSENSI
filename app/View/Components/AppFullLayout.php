<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppFullLayout extends Component
{
    public $header_title;
    public $header_action;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('layouts.app-full');
    }
}
