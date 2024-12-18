<?php

namespace App\Livewire\Admin\Pool;

use App\Models\Admin\Configs;
use App\Models\Admin\Pool\Pool;
use App\Models\Admin\Registers\Partner;
use Livewire\Component;

class RegisterAccessPool extends Component
{
    public $config;
    public $table = 'partners';
    public $partner;
    public $access_pool;
    public $version;

    public $status;
    public function mount(Partner $partner)
    {
        $this->config = Configs::find(1);
        $this->partner = $partner;
        $this->access_pool = implode("-", array_reverse(explode("/", $partner->access_pool)));
        $this->version = $partner->version_card ? $partner->version_card : 1;
    }
    public function render()
    {
        return view('livewire.admin.pool.register-access-pool')->layout('layouts.pool');
    }
    public function registerAccessPool()
    {
        $register = Pool::create([
            'table'         => $this->table,
            'register_id'   => $this->partner->id,
        ]);

        if ($register) {
            $this->status = 'success';
        } else {
            $this->status = 'error';
        }
    }
}
