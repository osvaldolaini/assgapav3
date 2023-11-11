<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class SearchBar extends Component
{
    public $openModalSearch = false;
    public $users;
    public $inputSearch = '';
    protected $listeners =
    [
        'closeReceived',
        'openModalSearch',
    ];

    public function render()
    {
        if ($this->inputSearch != '') {
            $this->users = User::where('name', 'LIKE', '%' . $this->inputSearch . '%')
            ->limit(10)->get();
        }

        return view('livewire.admin.search-bar');
    }
    public function openModalSearch()
    {
        $this->openModalSearch = true;
    }
    public function closeModalSearch()
    {
        $this->openModalSearch = false;
    }
}
