<?php

namespace App\Livewire\Admin\Sellers;

use App\Models\Admin\Configs\PartnerCategory;
use App\Models\Admin\Registers\Partner;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Register extends Component
{
    public $showModalCreate = false;
    public $rules;
    //Campos
    public $name;
    public $date_of_birth;
    public $deceased;
    public $pf_pj = 'pf';
    public $cpf;
    public $cnpj;
    public $phone_first;
    public $email;
    public $send_email_barthday = '1';
    public $registration_at;
    public $discount = '0';
    public $partner_category;
    public $partner_category_master = 'Não sócio';
    public $company;
    public $category = [];

    public $seller_id;

    public function resetAll()
    {
        $this->reset(
            'name',
            'email',
            'registration_at',
        );
    }
    public function mount()
    {
        $this->seller_id = Auth::user()->id;
    }
    public function modalRegister()
    {
        $this->resetAll();
        $this->showModalCreate = true;
        $this->registration_at = date('d/m/Y');
    }

    public function render()
    {
        $this->category = PartnerCategory::select('id', 'title')->orderBy('title', 'asc')
            ->where('see_seller', 1)->where('active', 1)->where('parent_category', $this->partner_category_master)->get();

        return view('livewire.admin.sellers.register');
    }
    public function fast_create()
    {
        $this->rules = [
            'name'              => 'required',
            'email'             => 'email|unique:partners',
            'registration_at'   => 'required',
        ];

        if ($this->pf_pj == 'pf') {
            $this->rules = [
                'cpf' => 'required|unique:partners|min:11',
            ];
        } else {
            $this->rules = [
                'cnpj' => 'required|unique:partners|min:14',
            ];
        }

        $this->validate();
        Partner::create([
            'active'                => 1,
            'name'                  => $this->name,
            'kinship'               => 'PRÓPRIO',
            'date_of_birth'         => $this->date_of_birth,
            'pf_pj'                 => $this->pf_pj,
            'cpf'                   => $this->cpf,
            'cnpj'                  => $this->cnpj,
            'phone_first'           => $this->phone_first,
            'email'                 => $this->email,
            'email_birthday'        => date('Y'),
            'send_email_barthday'   => $this->send_email_barthday,
            'registration_at'       => $this->registration_at,
            'discount'              => $this->discount,
            'partner_category'      => $this->partner_category,
            'partner_category_master'      => $this->partner_category_master,
            'created_by'            => Auth::user()->name,
            'seller_id'             => $this->seller_id,
        ]);

        $this->openAlert('success', 'Cadastro atualizado com sucesso.');
        $this->showModalCreate = false;
    }
    //MESSAGE
    public function openAlert($status, $msg)
    {
        $this->dispatch('openAlert', $status, $msg);
    }
}
