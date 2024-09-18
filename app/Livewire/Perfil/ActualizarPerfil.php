<?php

namespace App\Livewire\Perfil;

use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ActualizarPerfil extends Component
{
    public $state = [];

    public $verificationLinkSent = false;


    public function mount()
    {

        $user = Auth::user();

        $this->state = array_merge([
            'correo' => $user->correo,
        ], $user->withoutRelations()->toArray());
    }



    public function updateProfileInformation(UpdatesUserProfileInformation $updater)
    {
        $this->resetErrorBag();

        $updater->update(
            Auth::user(),
            $this->state
        );

        // if (isset($this->photo)) {
        //     return redirect()->route('profile.show');
        // }

        $this->dispatch('saved');

        // $this->dispatch('refresh-navigation-menu');
    }


    public function sendEmailVerification()
    {
        Auth::user()->sendEmailVerificationNotification();

        $this->verificationLinkSent = true;
    }


    public function getUserProperty()
    {
        return Auth::user();
    }


    public function render()
    {
        return view('livewire.perfil.actualizar-perfil');
    }
}
