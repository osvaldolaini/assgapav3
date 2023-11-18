<?php

namespace App\Livewire\Admin\Registers;

use App\Models\Admin\Configs\PartnerCategory;
use App\Models\Admin\Registers\Partner;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Intervention\Image\Facades\Image;

class OtherEdit extends Component
{
    public $category;
    public $rules;

    public $breadcrumb_title;
    //Campos
    public $id;
    public $name;
    public $responsible;
    public $kinship;
    public $image;
    public $date_of_birth;
    public $obs;
    public $pf_pj;
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
    public $send_email_barthday;
    public $needs;
    public $access_pool;
    public $print_date;
    public $validity_of_card;
    public $grace_period;
    public $registration_at;
    public $discount;
    public $partner_category;
    public $partner_category_master;
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

    public function mount(Partner $partner)
    {
        $this->breadcrumb_title = $partner->name;
        $this->registration_at = date('d/m/Y');
        $this->category = PartnerCategory::select('id','title')->orderBy('title','asc')
        ->where('active',1)->where('parent_category',$this->partner_category_master)->get();

        $this->id = $partner->id;
        $this->name = $partner->name;
        $this->responsible = $partner->responsible;
        $this->kinship = $partner->kinship;
        $this->image = $partner->image;
        $this->date_of_birth = $partner->date_of_birth;
        $this->obs = $partner->obs;
        $this->pf_pj = $partner->pf_pj;
        $this->cpf = $partner->cpf;
        $this->cnpj = $partner->cnpj;
        $this->rg = $partner->rg;
        $this->phone_first = $partner->phone_first;
        $this->phone_second = $partner->phone_second;
        $this->address = $partner->address;
        $this->city = $partner->city;
        $this->district = $partner->district;
        $this->state = $partner->state;
        $this->postalCode = $partner->postalCode;
        $this->number = $partner->number;
        $this->email = $partner->email;
        $this->send_email_barthday = $partner->send_email_barthday;
        $this->needs = $partner->needs;
        $this->access_pool = $partner->access_pool;
        $this->print_date = $partner->print_date;
        $this->validity_of_card = $partner->validity_of_card;
        $this->grace_period = $partner->grace_period;
        $this->registration_at = $partner->registration_at;
        $this->discount = $partner->discount;
        $this->partner_category = $partner->partner_category;
        $this->partner_category_master = $partner->partner_category_master;
        $this->company = $partner->company;

    }

    public function render()
    {
        if ($this->inputSearch != '') {
            $this->responsible_search = Partner::where('name', 'LIKE', '%' . $this->inputSearch . '%')
                ->where('partner_category_master', '!=', 'Dependente')
                ->limit(10)->get();
        }

        $this->category = PartnerCategory::select('id','title')->orderBy('title','asc')
        ->where('active',1)->where('parent_category',$this->partner_category_master)->get();
        return view('livewire.admin.registers.register-edit');
    }
    public function save()
    {
        $this->persist();
    }
    public function save_out()
    {
        $this->persist();
        $this->persist();
        if ($this->partner_category_master == 'Sócio') {
            redirect()->route('partners');
        } else {
            redirect()->route('others');
        }
    }
    public function persist()
    {
        $this->rules = [
            'name'              => 'required',
            'email'             => 'email',
            'date_of_birth'     => 'required',
            'registration_at'   => 'required',
            'phone_first'       => 'required',
        ];

        if ($this->pf_pj == 'pf') {
            $this->rules = [
                'cpf' => 'required|min:11',
            ];
        }else{
            $this->rules = [
                'cnpj' => 'required|min:14',
            ];
        }

        $this->validate();

        Partner::updateOrCreate([
            'id' => $this->id,
        ], [
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

            'updated_by'            =>Auth::user()->name,
        ]);
        $this->openAlert('success', 'Registro atualizado com sucesso.');
    }
    //MESSAGE
    public function openAlert($status, $msg)
    {
        $this->dispatch('openAlert', $status, $msg);
    }
}
