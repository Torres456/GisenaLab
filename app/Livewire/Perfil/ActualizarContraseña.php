<?php

namespace App\Livewire\Perfil;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;
use Livewire\Component;

class ActualizarContraseña extends Component
{

    public $state = [
        'current_password' => '',
        'contraseña' => '',
        'password_confirmation' => '',
    ];


    public function updatePassword(UpdatesUserPasswords $updater)
    {
        $this->resetErrorBag();

        $updater->update(Auth::user(), $this->state);

        if (request()->hasSession()) {
            request()->session()->put([
                'password_hash_' . Auth::getDefaultDriver() => Auth::user()->getAuthPassword(),
            ]);
        }

        $this->state = [
            'current_password' => '',
            'password' => '',
            'password_confirmation' => '',
        ];

        $this->dispatch('saved');
    }


    public function render()
    {
        return view('livewire.perfil.actualizar-contraseña');
    }
}
