<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Administrador extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'administrador';
    protected $table = 'administradores';
    protected $fillable = [
        'nome_completo',
        'login',
        'senha',
    ];

    protected $hidden = [
        'senha'
    ];

    public function getGuardName(): string
    {
        return $this->guard;
    }

    public function getAuthPassword()
    {
        return $this->senha;
    }
}
