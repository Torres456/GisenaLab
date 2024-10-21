<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Notifications\Notification;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokenS;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $table = 'usuario_sistema';
    protected $primaryKey = 'id_usuario_sistema';

    protected $fillable = [
        'nombre',
        'ap_paterno',
        'ap_materno',
        'correo',
        'contraseña',
        'estatus',
        'id_tipo_usuario'
    ];

    protected $hidden = [
        'contraseña',
        'remember_token',
        'id_tipo_usuario'
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'contraseña' => 'hashed',
        ];
    }

    public function tipo(): BelongsTo
    {
        return $this->belongsTo(tipo_usuario::class, 'id_tipo_usuario');
    }

    public function gestor(): HasOne
    {
        return $this->hasOne(gestor::class);
    }

    public function interesado(): HasOne
    {
        return $this->hasOne(interesado::class);
    }

    public function cliente(): HasOne
    {
        return $this->hasOne(cliente::class);
    }

    //get Email for email notification
    public function routeNotificationForMail(Notification $notification): array
    {
        return [$this->correo => $this->correo];
    }

    public function getEmailForVerification()
    {
        return $this->correo;
    }

    public function getAuthPassword()
    {
        return $this->contraseña;
    }

    public function getAuthPasswordName()
    {
        return 'contraseña';
    }

    //get Email for password reset form
    public function getEmailForPasswordReset()
    {
        return $this->correo;
    }

    //Check user type
    public function hasRole($role)
    {
        return $this->where('correo', $this->correo)->where('id_tipo_usuario', $role)->exists();
    }

    public function isSuperAdmin()
    {
        return $this->id_tipo_usuario == '6';
    }
}
