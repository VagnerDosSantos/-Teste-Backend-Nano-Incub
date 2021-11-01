<?php

namespace App\Repository;

use App\Models\Funcionario;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests\FuncionarioRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\{Auth, Hash};
use Illuminate\Support\Facades\DB;

class FuncionarioRepository
{
    public Model $funcionario;

    public function __construct(Funcionario $funcionario)
    {
        $this->funcionario = $funcionario;
    }

    public function pesquisar(Request $request): LengthAwarePaginator
    {
        return $this->funcionario->when($request->nome, function ($query) use ($request) {
            $query->where("nome_completo", "LIKE", "%{$request->nome}%");
        })->when($request->data, function ($query) use ($request) {
            $query->whereDate('created_at', $request->data);
        })->orderBy('nome_completo', 'asc')->paginate(25);
    }

    public function todosFuncionarios(): ?Collection
    {
        return $this->funcionario->withSum(['extrato' => function ($query) {
            $query->where('tipo_movimentacao', 'saida')->whereMonth('created_at', date('m'));
        }], 'valor')->get();
    }

    public function funcionario(int $id): Model
    {
        return $this->funcionario->findOrFail($id);
    }

    public function salvar(FuncionarioRequest $request): void
    {
        $request->validated();
        DB::transaction(function () use ($request) {
            $this->funcionario->create([
                'nome_completo' => $request->nome_completo,
                'login' => $request->login,
                'senha' => Hash::make($request->senha),
                'administrador_id' => Auth::user()->id,
            ]);
        });
    }

    public function atualizar(FuncionarioRequest $request, Funcionario $funcionario): void
    {
        DB::transaction(function () use ($funcionario, $request) {
            $funcionario->nome_completo = $request->nome_completo;
            $funcionario->login = $request->login;
            if (!empty($request->senha) && !empty($request->confirmacao_senha)) {
                $funcionario->senha = Hash::make($request->senha);
            }

            $funcionario->save();
        }, 1);
    }

    public function deletar(Funcionario $funcionario): void
    {
        DB::transaction(function () use ($funcionario) {
            $funcionario->delete();
        }, 1);
    }
}
