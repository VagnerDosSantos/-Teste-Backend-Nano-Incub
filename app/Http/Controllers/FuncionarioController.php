<?php

namespace App\Http\Controllers;

use App\Repository\FuncionarioRepository;
use Illuminate\Http\Request;
use App\Http\Requests\FuncionarioRequest;
use App\Models\Funcionario;

class FuncionarioController extends Controller
{
    private FuncionarioRepository $funcionario;

    public function __construct(FuncionarioRepository $funcionario)
    {
        $this->funcionario = $funcionario;
    }

    public function index(Request $request)
    {
        return view('funcionario.pesquisar', [
            'dados' => $this->funcionario->pesquisar($request)
        ]);
    }

    public function create()
    {
        $this->authorize('create', Funcionario::class);
        return view('funcionario.formulario', ['required' => 'required']);
    }

    public function edit(int $id)
    {
        $funcionario = $this->funcionario->funcionario($id);
        $this->authorize('update', [Funcionario::class, $funcionario]);
        return view('funcionario.formulario', [
            'funcionario' => $funcionario
        ]);
    }

    public function update(FuncionarioRequest $request, int $id)
    {
        $funcionario = $this->funcionario->funcionario($id);
        $this->authorize('update', [Funcionario::class, $funcionario]);

        $this->funcionario->atualizar($request, $funcionario);
        return redirect()->route('funcionario.pesquisar')
            ->with('sucesso', 'Cadastro atualizado com sucesso!');
    }

    public function store(FuncionarioRequest $request)
    {
        $this->authorize('create', Funcionario::class);
        $this->funcionario->salvar($request);
        return redirect()->route('funcionario.cadastrar')
            ->with('sucesso', 'Cadastro foi realizado com sucesso!');
    }

    public function destroy(int $id)
    {
        $funcionario = $this->funcionario->funcionario($id);
        $this->authorize('delete', [Funcionario::class, $funcionario]);
        $this->funcionario->deletar($funcionario);
    }

    public function extrato(int $id)
    {
        return view('funcionario.extrato', [
            'dados' => $this->funcionario->funcionario($id)
        ]);
    }
}
