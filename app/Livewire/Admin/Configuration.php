<?php

namespace App\Livewire\Admin;

use App\Models\Admin\Configs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Configuration extends Component
{
    use WithFileUploads;
    public $configs;
    public $id;
    public $title;
    public $slug;
    public $acronym;
    public $about;
    public $cpf_cnpj;
    public $email;
    public $phone;
    public $cellphone;
    public $whatsapp;
    public $telegram;
    public $updated_by;
    public $meta_description;
    public $meta_tags;
    public $video_link;
    public $postalCode;
    public $number;
    public $address;
    public $district;
    public $city;
    public $state;
    public $complement;
    public $uploadimage;
    public $logo;

    public $rules;

    public function mount()
    {
        $this->configs          = Configs::find(1);
        $this->id               = $this->configs->id;
        $this->title            = $this->configs->title;
        $this->about            = $this->configs->about;
        $this->slug             = $this->configs->slug;
        $this->acronym          = $this->configs->acronym;
        $this->cpf_cnpj         = $this->configs->cpf_cnpj;
        $this->email            = $this->configs->email;
        $this->phone            = $this->configs->phone;
        $this->cellphone        = $this->configs->cellphone;
        $this->whatsapp         = $this->configs->whatsapp;
        $this->telegram         = $this->configs->telegram;
        $this->meta_description = $this->configs->meta_description;
        $this->meta_tags        = $this->configs->meta_tags;
        $this->video_link       = $this->configs->video_link;
        $this->postalCode       = $this->configs->postalCode;
        $this->number           = $this->configs->number;
        $this->address          = $this->configs->address;
        $this->district         = $this->configs->district;
        $this->city             = $this->configs->city;
        $this->state            = $this->configs->state;
        $this->complement       = $this->configs->complement;

        $this->logo             = $this->configs->logo_path;
    }
    public function render()
    {
        if (Gate::allows('profile-user')) {
            abort(403);
        }
        return view('livewire.admin.configuration');
    }

     //BUSCAR CEP
     public function updated($property)
     {
         if ($property === 'postalCode') {
             $cep = str_replace ('-' ,'', $this->postalCode);
             // dd($cep);
             $ch = curl_init("https://viacep.com.br/ws/".$cep."/json/");
             curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
             $result = json_decode(curl_exec($ch));
             curl_close($ch);
             if($result){
                 $this->address = $result->logradouro;
                 $this->city = $result->localidade;
                 $this->district = $result->bairro;
                 $this->state = $result->uf;
             }
         }
     }

    public function update()
    {
        $this->rules = [
            'title'         => 'required|min:4|max:255',
        ];

        $this->validate();

        $this->configs = Configs::updateOrCreate([
            'id'        => $this->id,
        ], [
            'title'             => $this->title,
            'about'             => $this->about,
            'acronym'           => $this->acronym,
            'meta_description'  => $this->meta_description,
            'meta_tags'         => $this->meta_tags,
            'video_link'        => $this->video_link,
            'email'             => $this->email,
            'phone'             => $this->phone,
            'cellphone'         => $this->cellphone,
            'whatsapp'          => $this->whatsapp,
            'telegram'          => $this->telegram,
            'cpf_cnpj'          => $this->cpf_cnpj,
            'postalCode'        => $this->postalCode,
            'address'           => $this->address,
            'number'            => $this->number,
            'district'          => $this->district,
            'city'              => $this->city,
            'state'             => $this->state,
            'complement'        => $this->complement,
            'updated_by '       => Auth::user()->name,
        ]);
        $this->openAlert('success', 'Registro atualizado com sucesso.');
    }
    public function closeAlert()
    {
        $this->dispatch('closeAlert');
    }
    //pega o status do registro
    public function openAlert($status, $msg)
    {
        $this->dispatch('openAlert', $status, $msg);
    }
}
