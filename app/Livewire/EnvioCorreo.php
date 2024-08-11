<?php

namespace App\Livewire;

use App\Models\cliente;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Lazy;

#[lazy]
class EnvioCorreo extends Component
{

    public $correo;

    public $id;

    public $state = [];


    public function rules()
    {
        return [

            'correo' => ['required', 'string', 'email', 'max:255', 'unique:usuario_sistema'],

        ];
    }

    public function mount()
    {
        $user = Auth::user();

        $this->id = $user->idusuario_sistema;
        $this->correo = $user->correo;
    }

    public function getUserProperty()
    {
        return Auth::user();
    }

    public function update()
    {
        $this->validate();

        $user = User::find($this->id);

        $cliente = cliente::where('idusuario_sistema', $this->id)->first();

        DB::beginTransaction();

        try {
            $user->forceFill([
                'correo' => $this->correo,
            ])->save();

            $cliente->forceFill([
                'correo' => $this->correo,
            ])->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }

        $user->sendEmailVerificationNotification();

        session()->flash('success', '¡Te hemos enviado un nuevo enlace de verificación al correo que proporcionaste!');

        return redirect('/email/verify');
    }

    public function placeholder()
    {
        return view('livewire.placeholders.skeleton');
    }


    public function render()
    {
        return view('livewire.envio-correo');
    }
}
