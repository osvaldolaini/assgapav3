<?php

namespace App\Livewire\Admin;

use App\Models\Admin\UserAccess;
use App\Models\User;
use Livewire\Component;

class UserAccesses extends Component
{
    public $access;
    public $user;

    public function mount(User $user)
    {
        $this->access = $user->access->pluck('page_id')->toArray();
        $this->user= $user;
    }
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
    }
}
