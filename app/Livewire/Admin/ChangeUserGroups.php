<?php

namespace App\Livewire\Admin;

use App\Models\Admin\UserGroups;
use App\Models\User;
use Livewire\Component;

class ChangeUserGroups extends Component
{
    public $groups;
    public $user;
    public $user_groups_id;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->groups = UserGroups::get();
        $this->user_groups_id = $this->user->user_groups_id;
    }
    public function render()
    {
        return view('livewire.admin.change-user-groups');
    }
    public function changeGroup()
    {
        $this->user->user_groups_id = $this->user_groups_id;
        $this->user->save();
    }
}
