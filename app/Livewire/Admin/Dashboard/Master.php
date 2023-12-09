<?php

namespace App\Livewire\Admin\Dashboard;

use App\Models\Admin\Registers\Partner;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Master extends Component
{
    public function render()
    {
        switch (Auth::user()->dashboard) {
            case 1:
                return view('livewire.admin.dashboard.master');
                break;
            case 2:
                return view('livewire.admin.dashboard.financial');
                break;
            case 3:
                return view('livewire.admin.dashboard.secretary');
                break;
            case 4:
                return view('livewire.admin.dashboard.director');
                break;
            default:
                return view('livewire.admin.dashboard.director');
                break;
        }
    }
}
