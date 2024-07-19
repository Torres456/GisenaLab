<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $table = 'usuario_sistema';
    protected $primaryKey = 'idusuario_sistema';
  

    protected $fillable = [
        'correo',
        'contraseña',
        'estatus',
        'idtipo_usuario'
    ];

   
    protected $hidden = [
        'contraseña',
        'remember_token',
        'idtipo_usuario'
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
        return $this->belongsTo(tipo_usuario::class, 'idtipo_usuario');
    }

    public function gestor(): HasOne
    {
        return $this->hasOne(gestor::class);
    }


    public function cliente(): HasOne
    {
        return $this->hasOne(cliente::class);
    }
}
