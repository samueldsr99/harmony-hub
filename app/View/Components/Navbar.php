<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Navbar extends Component
{
    public array $menu_items;

    public array $home_menu_items;

    public array $admin_menu_items;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
        $this->menu_items = [
            ['label' => 'Explore', 'route' => 'playlists.index', 'url' => null],
            ['label' => 'My playlists', 'route' => 'playlists.mine', 'url' => null],
            ['label' => 'Users', 'route' => 'users.index', 'url' => null],
            ['label' => 'Inspire', 'route' => 'inspire.index', 'url' => null]
        ];

        $this->home_menu_items = [
        ];

        $this->admin_menu_items = [
            ['label' => 'Playlists', 'route' => 'admin.playlists.index', 'url' => null],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navbar');
    }
}
