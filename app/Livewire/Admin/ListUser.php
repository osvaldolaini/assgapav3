<?php

namespace App\Livewire\Admin;

use App\Models\Admin\UserGroups;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;

use Laravel\Fortify\Rules\Password;

class ListUser extends Component
{
    use WithPagination;
    public $paginate;
    public $showJetModal = false;
    public $showModalView = false;
    public $showModalCreate = false;
    public $showModalEdit = false;
    public $alertSession = false;
    public $rules;
    public $detail;

    public $model_id;
    public $registerId;

    public $name;
    public $email;
    public $password;
    public $user_groups_id;
    public $groups;

    protected $listeners =
    [
        'showModalRead',
        'showModalUpdate',
        'showModalDelete'
    ];

    public function mount()
    {
        $this->groups = UserGroups::get();
    }
    public function render()
    {
        if (Gate::allows('profile-user')) {
            abort(403);
        }
        return view('livewire.admin.list-user', [
            'users' => User::paginate($this->paginate),
        ]);
    }
    public function resetAll()
    {
        $this->reset(
            'name',
            'email',
            'password',
            'user_groups_id',
        );
    }
    //CREATE
    public function modalCreate()
    {
        $this->resetAll();
        $this->showModalCreate = true;
    }
    public function store()
    {
        $this->rules = [
            'name'      => 'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|string',
            'user_groups_id'  => 'required',
        ];
        $this->validate();
        User::create([
            'name'      => $this->name,
            'email'     => $this->email,
            'password'  => Hash::make($this->password),
            'user_groups_id'  => $this->user_groups_id,
        ]);

        $this->openAlert('success', 'Registro criado com sucesso.');

        $this->showModalCreate = false;
        $this->resetAll();
    }

    //READ
    public function showModalRead($id)
    {
        $this->showModalView = true;

        if (isset($id)) {
            $data = User::where('id', $id)->first();

            $this->detail = [
                'Criada'            => $data->created,
                'Criada por'        => $data->created_by,
                'Atualizada'        => $data->updated,
                'Atualizada por'    => $data->updated_by,
            ];
        } else {
            $this->detail = '';
        }
    }
    //UPDATE
    public function showModalUpdate(User $user)
    {
        $this->resetAll();

        $this->model_id      = $user->id;
        $this->name          = $user->name;
        $this->email         = $user->email;
        $this->user_groups_id      = $user->user_groups_id;
        $this->showModalEdit = true;
    }
    public function update()
    {
        $this->rules = [
            'name'      => 'required',
            'email'     => 'required|email|'.Rule::unique('users')->ignore($this->model_id),
            'user_groups_id'  => 'required',
        ];

        if ($this->password) {
            $this->rules = [
                'password'  => $this->passwordRules(),
            ];
        }

        $this->validate();

        User::updateOrCreate([
            'id' => $this->model_id,
        ], [
            'name'      => $this->name,
            'email'     => $this->email,
            'user_groups_id'  => $this->user_groups_id,
        ]);

        if ($this->password) {
            User::updateOrCreate([
                'id' => $this->model_id,
            ], [
                'password'  => Hash::make($this->password),
            ]);
        }

        $this->openAlert('success', 'Registro atualizado com sucesso.');

        $this->showModalEdit = false;
        $this->resetAll();
    }
    //DELETE
    public function showModalDelete($id)
    {
        $this->showJetModal = true;
        if (isset($id)) {
            $this->registerId = $id;
        } else {
            $this->registerId = '';
        }
    }
    public function delete($id)
    {
        $data = User::find($id);
        $data->delete();

        $this->openAlert('success', 'Registro excluido com sucesso.');

        $this->showJetModal = false;
        $this->resetAll();
    }

    //OPEN MESSAGE
    //pega o status do registro
    public function openAlert($status, $msg)
    {
        $this->dispatch('openAlert', $status, $msg);
    }
    #END FUNCTIONS BUTTONS AND MESSAGE
}
