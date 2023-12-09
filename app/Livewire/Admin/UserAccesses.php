<?php

namespace App\Livewire\Admin;

use App\Models\Admin\UserAccess;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class UserAccesses extends Component
{
    public $access;
    public $user;
    public $breadcrumb_title;
    public $dashboard;

    public function mount(User $user)
    {
        $this->access = $user->access->pluck('page_id')->toArray();
        $this->user= $user;
        $this->breadcrumb_title = 'ACESSOS DE: '.strtoupper($user->name);
    }
    #[On('refresh')]
    public function render()
    {
        return view('livewire.admin.user-accesses');
    }

    public function changeAccess($pageId)
    {
        $page = UserAccess::where('user_id',$this->user->id)
        ->where('page_id',$pageId)
        ->first();

        if ($page) {
            $page->delete();
        }else{
            UserAccess::create([
                'user_id' => $this->user->id,
                'page_id' => $pageId,
            ]);
        }
        $this->dispatch('updateSideBar');
    }

    public function changeDashboard($dashboard)
    {
        $this->user->dashboard = $dashboard;
        $this->user->save();

        $this->dispatch('refresh');
    }
}
