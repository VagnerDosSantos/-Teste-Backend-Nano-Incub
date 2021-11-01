<?php

namespace App\Http\Controllers;

use App\Repository\FuncionarioRepository;

class HomeController extends Controller
{
    private FuncionarioRepository $funcionario;

    public function __construct(FuncionarioRepository $funcionario)
    {
        $this->funcionario = $funcionario;
    }

    public function index()
    {
        $dados = $this->funcionario->todosFuncionarios();
        return view('dashboard', [
            'funcionarios' => $dados
        ]);
    }
}
