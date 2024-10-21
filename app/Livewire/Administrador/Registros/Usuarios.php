<?php

namespace App\Livewire\Administrador\Registros;

use App\Models\tipo_usuario;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Hash;

use App\Rules\Password;
use Illuminate\Support\Facades\Gate;

use function Laravel\Prompts\confirm;

class Usuarios extends Component
{
    use WithPagination;

    public $open = false;

    public $tipos;

    public $tipo_usuario = 0;

    public $email_verification = 0;

    public $search = '';

    public $status = 0;

    public $users;

    public $quantity = 10;

    public $estado = false;

    // Form
    public $nombre = '';

    public $email = '';

    public $password = '';

    public $password_confirmation = '';

    public $type = 0;

    public function mount()
    {

        $this->tipos = tipo_usuario::where('estatus', 1)->get();
    }

    public function rules()
    {

        return [
            'nombre' => 'required|min:3|max:150|unique:usuario_sistema',
            'email' => 'required|email|max:150|unique:usuario_sistema,correo|unique:cliente,correo|unique:contacto,correo',
            'password' => [
                'required',
                'confirmed',
                Password::default(),
            ],
            'type' => 'required|numeric|min:1|max:6',
        ];
    }

    public function messages()
    {

        return [
            'type.min' => 'Selecciona un tipo de usuario.',
        ];
    }

    public function save()
    {

        $this->validate();

        switch ($this->type) {

            case 1:

                $this->save_admin();

                break;

            case 6:
                $this->save_admin();

                break;

            default:

                User::create([
                    'nombre' => $this->nombre,
                    'correo' => $this->email,
                    'contraseña' => Hash::make($this->password),
                    'estatus' => 1,
                    'id_tipo_usuario' => $this->type,
                ]);

                $this->save_modal();
        }
    }

    public function save_admin()
    {
        $this->validate();

        if (Gate::allows('admin-options', 6)) {
            User::create([
                'nombre' => $this->nombre,
                'correo' => $this->email,
                'contraseña' => Hash::make($this->password),
                'estatus' => 1,
                'id_tipo_usuario' => $this->type,
            ]);

            $this->save_modal();
        } else {

            $this->error_modal();
        }
    }

    public function state($userId)
    {

        $user = User::findOrFail($userId);

        if ($user->id_tipo_usuario == 1) {

            $this->state_Admin($user);
        } else if ($user->id_tipo_usuario == 6) {

            $this->state_Admin($user);
        } else {

            if ($user->estatus) {

                $user->estatus = 0;
            } else {

                $user->estatus = 1;
            }

            $user->save();

            $this->render();

            session()->flash('green', 'Acción completada.');
        }
    }

    public function state_Admin($user)
    {

        if (Gate::allows('admin-options', 6)) {

            if ($user->estatus) {
                $user->estatus = 0;
            } else {
                $user->estatus = 1;
            }

            $user->save();

            $this->render();

            session()->flash('green', 'Acción completada.');
        } else {

            $this->error_modal();
        }
    }

    public function error_modal()
    {
        $this->open = false;
        session()->flash('red', 'Error al ejecutar la acción.');

        return false;
    }

    public function save_modal()
    {
        $this->open = false;

        session()->flash('green', 'Usuario creado correctamente.');
    }


    public function modal()
    {

        $this->open = !$this->open;

        $this->reset(['nombre', 'email', 'password', 'password_confirmation']);

        $this->type = 0;

        $this->resetErrorBag();

        $this->resetValidation();
    }

    public function close_modal()
    {

        $this->open = false;
    }

    public function searching()
    {

        $this->resetPage();
        $this->render();
        $this->toggleVisibility();
    }

    public function resets()
    {

        $this->resetPage();
        $this->render();
        $this->search = null;
        $this->toggleVisibility();
    }

    public function toggleVisibility()
    {

        if ($this->search) {
            $this->estado = true;
        } else {
            $this->estado = false;
        }
    }

    public function render()
    {
        $usuarios = User::orderBy('id_usuario_sistema', 'desc');

        if ($this->tipo_usuario) {
            $usuarios->where('id_tipo_usuario', $this->tipo_usuario);
        }

        if ($this->status) {

            switch ($this->status) {

                case 1:
                    $usuarios->where('estatus', 1);

                    break;

                case 2:
                    $usuarios->where('estatus', 0);

                    break;
            }
        }

        if ($this->email_verification) {

            switch ($this->email_verification) {

                case 1:
                    $usuarios->whereNotNull('email_verified_at');

                    break;

                case 2:
                    $usuarios->where('email_verified_at', NULL);

                    break;
            }
        }

        $usuarios->where(function ($query) {
            $query->where('correo', 'like', '%' . $this->search . '%')
                ->orWhere('nombre', 'like', '%' . $this->search . '%');
        });

        $usuarios = $usuarios->paginate($this->quantity);
        return view('livewire.administrador.registros.usuarios', compact('usuarios'));
    }
}
