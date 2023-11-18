<?php

namespace App\Livewire\Admin\Registers;

use App\Models\Admin\Configs\PartnerCategory;
use App\Models\Admin\Registers\Partner;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Intervention\Image\Facades\Image;

class DependentNew extends Component
{
    public $category;
    public $rules;

    public $breadcrumb_title;
    //Campos
    public $name;
    public $responsible;
    public $kinship;
    public $image;
    public $date_of_birth;
    public $obs;
    public $pf_pj = 'pf';
    public $cpf;
    public $cnpj;
    public $rg;
    public $phone_first;
    public $phone_second;
    public $address;
    public $city;
    public $district;
    public $state;
    public $postalCode;
    public $number;
    public $email;
    public $send_email_barthday = '1';
    public $needs = '0';
    public $access_pool;
    public $print_date;
    public $validity_of_card;
    public $grace_period;
    public $registration_at;
    public $discount = '0';
    public $partner_category;
    public $partner_category_master = 'Dependente';
    public $company;

    public $inputSearch;
    public $responsible_search;
    public $responsible_name;
    public $modalSearch = false;

    public $newImg = '';

    protected $listeners =
    [
        'uploadingImage',
    ];

    //SEARCH RESPONSIBLE
    public function openModalSearch()
    {
        $this->modalSearch = true;
    }
    public function selectResponsible($id)
    {
        $partner = Partner::find($id);
        $this->responsible_name = $partner->name . ' ( ' . $partner->cpf . ' )';
        $this->responsible = $partner->id;
        $this->modalSearch = false;
    }

    //UPLOAD PHOTO
    public function uploadingImage($image)
    {
        $this->newImg = $image;
    }
    public static function uploadPhoto($image)
    {
        // dd('storage/public/livewire-tmp/' . $image);
        $img = explode('.',$image);
        $logoWebp = Image::make('storage/livewire-tmp/' . $image);
        $logoWebp->encode('webp', 80);
        $logoWebp->save('storage/partners/' . $img[0] . '.webp');

        $logoPng = Image::make('storage/livewire-tmp/' . $image);
        $logoPng->encode('png', 80);
        $logoPng->save('storage/partners/' . $img[0] . '.jpg');
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

    public function mount(Partner $partner)
    {
        $this->responsible_name = $partner->name . ' ( ' . $partner->cpf . ' )';
        $this->responsible = $partner->id;
        $this->breadcrumb_title = 'DEPENDENTE DE: '.$partner->name;

        $this->registration_at = date('d/m/Y');
        $this->category = PartnerCategory::select('id','title')->orderBy('title','asc')
        ->where('active',1)->where('parent_category',$this->partner_category_master)->get();
    }
    public function render()
    {
        if ($this->inputSearch != '') {
            $this->responsible_search = Partner::where('name', 'LIKE', '%' . $this->inputSearch . '%')
                ->where('partner_category_master', '!=', 'Dependente')
                ->limit(7)->get();
        }

        $this->category = PartnerCategory::select('id','title')->orderBy('title','asc')
        ->where('active',1)->where('parent_category',$this->partner_category_master)->get();
        return view('livewire.admin.registers.register-new');
    }

    public function save_out()
    {
        $this->rules = [
            'name'              => 'required|unique:partners',
            'email'             => 'email',
            'date_of_birth'     => 'required',
            'registration_at'   => 'required',
            'phone_first'       => 'required',
        ];

        if ($this->pf_pj == 'pf') {
            $this->rules = [
                'cpf' => 'required|unique:partners|min:11',
            ];
        }else{
            $this->rules = [
                'cnpj' => 'required|unique:partners|min:14',
            ];
        }

        if ($this->newImg) {
            $this->image = $this->newImg;
            $this->uploadPhoto($this->image);
        }

        $this->validate();
        Partner::create([
            'active'                =>1,
            'name'                  =>$this->name,
            'responsible'           =>$this->responsible,
            'kinship'               =>'PRÓPRIO',
            'image'                 =>$this->image,
            'date_of_birth'         =>$this->date_of_birth,
            'obs'                   =>$this->obs,
            'pf_pj'                 =>$this->pf_pj,
            'cpf'                   =>$this->cpf,
            'cnpj'                  =>$this->cnpj,
            'rg'                    =>$this->rg,
            'phone_first'           =>$this->phone_first,
            'phone_second'          =>$this->phone_second,
            'address'               =>$this->address,
            'city'                  =>$this->city,
            'district'              =>$this->district,
            'state'                 =>$this->state,
            'postalCode'            =>$this->postalCode,
            'number'                =>$this->number,
            'email'                 =>$this->email,
            'email_birthday'        =>date('Y'),
            'send_email_barthday'   =>$this->send_email_barthday,
            'needs'                 =>$this->needs,
            'access_pool'           =>$this->access_pool,
            'print_date'            =>$this->print_date,
            'validity_of_card'      =>$this->validity_of_card,
            'grace_period'          =>$this->grace_period,
            'registration_at'       =>$this->registration_at,
            'discount'              =>$this->discount,
            'partner_category'      =>$this->partner_category,
            'company'               =>$this->company,
            'created_by'            =>Auth::user()->name,
        ]);

        $this->openAlert('success', 'Registro atualizado com sucesso.');
        redirect()->route('partners');
    }

    //MESSAGE
    public function openAlert($status, $msg)
    {
        $this->dispatch('openAlert', $status, $msg);
    }
}
