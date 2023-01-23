<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\SiteInformation;

class AppLayout extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title;
    public function __construct($title)
    {
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $site = SiteInformation::latest()->first(['address', 'telp', 'email', 'facebook', 'twitter', 'instagram', 'linkedin']);
        return view('layouts.app', [
            'site' => $site
        ]);
    }
}
