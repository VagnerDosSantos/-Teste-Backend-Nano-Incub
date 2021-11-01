<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Funcionario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = "funcionario";
    protected $table = "funcionarios";
    protected $fillable = [
        "nome_completo",
        "login",
        "senha",
        "administrador_id"
    ];

    protected $hidden = [
        "senha"
    ];

    public function getGuardName(): string
    {
        return $this->guard;
    }

    public function getAuthPassword()
    {
        return $this->senha;
    }

    public function extrato()
    {
        return $this->hasMany(Movimentacao::class, 'funcionario_id', 'id')->orderBy('created_at', 'desc');
    }

    public static function booted()
    {
        static::deleting(function ($funcionario) {
            $funcionario->extrato()->delete();
        });
    }
}
