<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimentacao extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    protected $table = "movimentacoes";
    protected $fillable = [
        "tipo_movimentacao",
        "valor",
        "observacao",
        "funcionario_id",
        "administrador_id"
    ];
    
    public function funcionario()
    {
        return $this->hasOne(Funcionario::class, 'id', 'funcionario_id')->withDefault();
    }
}
