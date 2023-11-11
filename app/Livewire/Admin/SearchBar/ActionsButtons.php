<?php

namespace App\Livewire\Admin\SearchBar;

use Livewire\Component;

class ActionsButtons extends Component
{
    public $search_id;

    public $alertSession = false;

    protected $listeners =
    [
        'openAlert'
    ];

    public function mount($search_id)
    {
        $this->search_id = $search_id;
    }

    public function render()
    {
        return view('livewire.admin.search-bar.actions-buttons');
    }

    //CREATE
    public function showModalCreate()
    {
        $this->dispatch('showModalCreate');
    }
    //READ
    public function showModalRead($id)
    {
        $this->dispatch('showModalRead', $id);
    }
    //UPDATE
    public function showModalUpdate($id)
    {
        $this->dispatch('showModalUpdate', $id);
    }
    //DELETE
    public function showModalDelete($id)
    {
        $this->dispatch('showModalDelete', $id);
    }
    //OPEN MESSAGE
    public function openAlert($status, $msg)
    {
        session()->flash($status, $msg);
        $this->alertSession = true;
    }
    //CLOSE MESSAGE
    public function closeAlert()
    {
        $this->alertSession = false;
    }
}
