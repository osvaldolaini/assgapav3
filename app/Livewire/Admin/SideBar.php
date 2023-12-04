<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SideBar extends Component
{
    public $pages;
    protected $listeners =
    [
        'updateSideBar'
    ];
    public function updateSideBar()
    {
        $this->pages = Auth::user()->access->pluck('page_id')->toArray();
    }
    public function render()
    {
        $this->pages = Auth::user()->access->pluck('page_id')->toArray();
        return view('livewire.admin.side-bar');
    }
}
