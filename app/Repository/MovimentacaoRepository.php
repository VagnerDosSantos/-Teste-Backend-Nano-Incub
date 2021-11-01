<?php

namespace App\Repository;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\{Funcionario, Movimentacao};
use Illuminate\Support\Facades\{Auth, DB};
use App\Http\Requests\MovimentacaoRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Carbon\{Carbon, CarbonInterval};

class MovimentacaoRepository
{
    private Model $movimentacao;

    public function __construct(Movimentacao $movimentacao)
    {
        $this->movimentacao = $movimentacao;
    }

    public function pesquisar(Request $request): LengthAwarePaginator
    {
        return $this->movimentacao->when($request->tipo, function ($query) use ($request) {
            $query->where('tipo_movimentacao', $request->tipo);
        })->when($request->data, function ($query) use ($request) {
            $query->whereDate('created_at', $request->data);
        })->whereHas('funcionario', function ($query) use ($request) {
            $query->where("nome_completo", "LIKE", "%$request->nome%");
        })->orderBy("created_at", 'desc')->paginate(25);
    }

    public function salvar(MovimentacaoRequest $request, int $id): void
    {
        $request->validated();
        $funcionario = Funcionario::find($id);
        $valor = $this->converteDecimal($request->valor);

        // Verifica o tipo de entrada
        $tipoMovimentacao = ($request->tipo_movimentacao === "entrada") ? "increment" : "decrement";
        if ($this->verificaSaldo($request->tipo_movimentacao, $funcionario->saldo_atual, $valor)) {
            $request->session()->flash('erro', 'Este funcionário não possui saldo suficiente para realizar esta operação!');
            return;
        }

        DB::transaction(function () use ($funcionario, $request, $tipoMovimentacao, $valor) {
            $funcionario->$tipoMovimentacao('saldo_atual', $valor);
            $funcionario->save();

            $this->movimentacao->create([
                'tipo_movimentacao' => $request->tipo_movimentacao,
                'valor' => $valor,
                'observacao' => $request->observacao,
                'funcionario_id' => $request->id,
                'administrador_id' => Auth::user()->id,
            ]);
        }, 1);
    }

    private function verificaSaldo(string $tipoMovimentacao, float $saldoFuncionario, float $valor): bool
    {
        return ($tipoMovimentacao === "saida" && $saldoFuncionario < $valor);
    }

    private function converteDecimal(string $valor): float
    {
        $valor = str_replace(['.', ','], ['', '.'], $valor);
        return floatval($valor);
    }

    public function ultimasMovimentacoes(): string
    {
        $dados = [];
        $carbon = Carbon::now();

        $dataFinal = $carbon->endOfMonth()->format('Y-m-d');
        $dataInicial = $carbon->startOfMonth()->sub(CarbonInterval::months(11))->format('Y-m-d');

        $movimentacao = $this->movimentacao->whereBetween('created_at', [$dataInicial, $dataFinal])
            ->get(['tipo_movimentacao', 'valor', 'created_at']);

        $dados[0] = [
            'name' => 'Bonificações',
            'data' => array_values($this->movimentacaoAnual('saida', $movimentacao))
        ];

        $dados[1] = [
            'name' => 'Saldo',
            'data' => array_values($this->movimentacaoAnual('entrada', $movimentacao))
        ];

        return json_encode(array_values($dados));
    }

    /**
     * Função para somar os valores de cada mês
     * @var string $tipo = enum['entrada', 'saida']
     * @var object $dados = dados recuperados na query
     */
    private function movimentacaoAnual(string $tipo, object $dados): array
    {
        $inicio = Carbon::now()->startOfMonth()->sub(CarbonInterval::months(11));

        $array = [];

        for ($i = 0; $i < 12; $i++) {
            $array[$inicio->format('m')] = $dados->filter(function ($value) use ($tipo, $inicio) {
                return $value->tipo_movimentacao === $tipo;
            })->whereBetween(
                'created_at',
                [$inicio->copy()->startOfMonth()->format('Y-m-d'), $inicio->copy()->endOfMonth()->format('Y-m-d')]
            )->sum('valor');

            $inicio->addMonth(1);
        }

        return $array;
    }
}
