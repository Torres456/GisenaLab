<?php

namespace App\Livewire;

use App\Models\cliente;
use App\Models\contacto;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Lazy;

#[lazy]
class EnvioCorreo extends Component
{

    public $correo;

    public $correoc;

    public $id;

    public $state = [];


    public function rules()
    {
        return [

            'correo' => ['required', 'string', 'email', 'max:255', 'unique:usuario_sistema', 'unique:cliente', 'unique:contacto'],

        ];
    }

    public function mount()
    {
        $user = Auth::user();

        $this->id = $user->id_usuario_sistema;
        $this->correo = $user->correo;
        $this->correoc = $user->correo;
    }

    public function getUserProperty()
    {
        return Auth::user();
    }

    public function update()
    {
        $this->validate();

        $user = User::find($this->id);

        $cliente = cliente::where('id_usuario_sistema', $this->id)->first();


        if ($cliente->tipo == '1') {

            $contacto = contacto::where('correo', $this->correoc)->first();

            DB::beginTransaction();

            try {
                $user->forceFill([
                    'correo' => $this->correo,
                ])->save();

                $cliente->forceFill([
                    'correo' => $this->correo,
                ])->save();

                $contacto->forceFill([
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
        } else if ($cliente->tipo == '2') {

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
        } else {
        }
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
