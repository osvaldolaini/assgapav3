<?php

namespace App\Livewire\Admin\Pool;

use App\Models\Admin\Configs;
use App\Models\Admin\Pool\Pass;
use App\Models\Admin\Pool\Pool;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RegisterPassPool extends Component
{
    public $config;
    public $table = 'passes';
    public $pass;
    public $validity_of_card;
    public $partner;

    public $status;
    public function mount(Pass $pass)
    {
        if ($pass->indication_id) {
            $this->partner = $pass->partners->name;
        }else{
            $this->partner = '';
        }
        $this->config = Configs::find(1);
        $this->pass = $pass;
        $this->validity_of_card = implode("-",array_reverse(explode("/",$pass->validity_of_card)));
    }
    public function render()
    {
        return view('livewire.admin.pool.register-pass-pool')->layout('layouts.pool');
    }
    public function registerAccessPool()
    {
        $register = Pool::create([
            'table'         => $this->table,
            'register_id'   => $this->pass->id,
            'client'   => $this->pass->partner,
            'partner'   => $this->partner,
        ]);

        if($register){
            $this->status = 'success';
        }else{
            $this->status = 'error';
        }
    }
}
