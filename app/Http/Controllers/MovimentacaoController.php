<?php

namespace App\Http\Controllers;

use App\Repository\MovimentacaoRepository;
use App\Repository\FuncionarioRepository;
use App\Http\Requests\MovimentacaoRequest;
use App\Models\Movimentacao;
use Illuminate\Http\Request;

class MovimentacaoController extends Controller
{
    private MovimentacaoRepository $movimentacao;
    private FuncionarioRepository $funcionario;

    public function __construct(MovimentacaoRepository $movimentacao, FuncionarioRepository $funcionario)
    {
        $this->movimentacao = $movimentacao;
        $this->funcionario = $funcionario;
    }

    public function index(Request $request)
    {
        return view('movimentacao.pesquisar', [
            'dados' => $this->movimentacao->pesquisar($request)
        ]);
    }

    public function funcionarios(Request $request)
    {
        $this->authorize('create', Movimentacao::class);
        return view('funcionario.pesquisar', [
            'dados' => $this->funcionario->pesquisar($request)
        ]);
    }

    public function create(int $id)
    {
        $this->authorize('create', Movimentacao::class);
        return view('movimentacao.cadastrar', [
            'funcionario' => $this->funcionario->funcionario($id)
        ]);
    }

    public function store(MovimentacaoRequest $request, int $id)
    {
        $this->authorize('create', Movimentacao::class);
        $this->movimentacao->salvar($request, $id);
        return redirect()->route('movimentacao.pesquisar')->with('sucesso', 'Operação realizada com sucesso!');
    }

    /**
     * Essa rota é exclusiva pra pegar dados do gráfico do dashboard
     */
    public function ultimasMovimentacoes()
    {
        echo $this->movimentacao->ultimasMovimentacoes();
    }
}
