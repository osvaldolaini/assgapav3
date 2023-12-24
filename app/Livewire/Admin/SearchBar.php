<?php

namespace App\Livewire\Admin;

use App\Models\Admin\Registers\Partner;
use Livewire\Component;

class SearchBar extends Component
{
    public $navModalSearch = false;
    public $users;
    public $navSearch = '';
    public $resultSearch = '';

    public function render()
    {
        if ($this->navSearch != '') {
            $this->resultSearch = Partner::select('id','name','cpf','partner_category_master','image')
            ->where('name', 'LIKE', '%' . $this->navSearch . '%')
            ->limit(7)->get();
        }

        return view('livewire.admin.search-bar');
    }
    public function goTo(Partner $partner)
    {
        switch ($partner->partner_category_master) {
            case 'Dependente':
                redirect()->route('edit-dependent', $partner->id);
                break;
            case 'Não sócio':
                redirect()->route('edit-other', $partner->id);
                    break;

            default:
            redirect()->route('edit-partner', $partner->id);
                break;
        }
    }
    public function openNavModalSearch()
    {
        $this->navModalSearch = true;
    }
    public function closeNavModalSearch()
    {
        $this->navModalSearch = false;
    }
}
