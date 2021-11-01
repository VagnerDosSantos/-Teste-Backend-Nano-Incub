@extends('templates.app')

@section('conteudo')
    <div class="card">
        <div class="card-header">
            <i class="material-icons left">search</i> Pesquisar Funcionários
        </div>

        <div class="card-body">
            <form>
                <div class="row">
                    @csrf
                    <div class="input-field col s12 m9">
                        <label for="nome">Pesquisa Rápida</label>
                        <input type="text" name="nome" value="{{ Request()->nome }}" id="nome"
                            placeholder="Digite o nome do funcionário que deseja pesquisar" class="validate">
                    </div>

                    <div class="input-field col s12 m3">
                        <input type="date" name="data" value="{{ Request()->data }}" class="validate" id="data">
                        <label for="data">Data de Criação</label>
                    </div>

                    <div class="input-field col s12 right-align">
                        <button type="submit" class="btn btn-small waves-effect waves-light green accent-4">Aplicar
                            filtro</button>
                        @if ($rota = Route('movimentacao.funcionarios') !== url()->current())
                            @can('create', App\Models\Funcionario::class)
                                <a class="btn btn-small waves-effect waves-light blue accent-4"
                                    href="{{ route('funcionario.cadastrar') }}">Novo Funcionário
                                </a>
                            @endcan
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <table class="card-body responsive-table highlight">
            <thead>
                <tr>
                    <th class="center-align largura-minima">ID</th>
                    <th>Nome</th>
                    <th class="center-align largura-minima">Saldo</th>
                    <th class="center-align nowrap largura-minima">Criado em</th>
                    <th class="center-align largura-minima">Ação</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($dados as $funcionario)
                    <tr id="linha{{ $funcionario->id }}">
                        <td class="center-align">{{ $funcionario->id }}</td>
                        <td>{{ $funcionario->nome_completo }}</td>
                        <td class="nowrap">R$ {{ number_format($funcionario->saldo_atual, 2, ',', '.')  }}</td>
                        <td class="nowrap">{{ date('d-m-Y H:i:s', strtotime($funcionario->created_at)) }}</td>
                        <td class="center-align nowrap">
                            @if ($rota)
                                @can('delete', App\Models\Funcionario::class)
                                    <excluir-funcionario id="{{ $funcionario->id }}"></excluir-funcionario>
                                @endcan

                                <a class="btn btn-small waves-effect waves-light green accent-4 tooltip" data-position="top"
                                    data-tooltip="Exibir extrato"
                                    href="{{ route('funcionario.extrato', ['id' => $funcionario->id]) }}">
                                    <i class="material-icons">receipt_long</i>
                                </a>

                                @can('update', [App\Models\Funcionario::class, $funcionario])
                                    <a href="{{ route('funcionario.editar', ['id' => $funcionario->id]) }}"
                                        class="btn btn-small waves-effect waves-light blue accent-4 tooltip" data-position="top"
                                        data-tooltip="Editar cadastro">
                                        <i class="material-icons">edit</i>
                                    </a>
                                @endcan
                            @else
                                <a class="btn btn-small waves-effect waves-light blue accent-4"
                                    href="{{ route('movimentacao.cadastrar', ['id' => $funcionario->id]) }}">
                                    Selecionar
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $dados->withQueryString()->links() }}
    </div>

    <div id="modal1" class="modal">
        <div class="modal-content">
            <h4>Modal Header</h4>
            <p>A bunch of text</p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
        </div>
    </div>
@endsection
