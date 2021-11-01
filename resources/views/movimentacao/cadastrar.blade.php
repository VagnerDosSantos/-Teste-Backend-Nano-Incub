@extends('templates.app')

@section('conteudo')
    <div class="card">
        <div class="card-header">
            <i class="material-icons left">attach_money</i> Movimentação
        </div>

        <form method="post">
            @csrf

            <div class="card-body">
                <div class="row">
                    <div class="input-field col s10">
                        <label for="funcionario">Funcionário</label>
                        <input type="text" readonly value="{{ $funcionario->nome_completo }}">
                    </div>

                    <div class="input-field col s2">
                        <label for="funcionario">Saldo</label>
                        <input type="text" readonly value="R$ {{ number_format($funcionario->saldo_atual, 2, ',', '.')  }}">
                    </div>

                    <div class="input-field col s12 m2">
                        <select name="tipo_movimentacao" id="tipo_movimentacao" required>
                            <option value="">Selecione</option>
                            <option value="entrada">Entrada</option>
                            <option value="saida">Saída</option>
                        </select>
                        <label for="tipo_movimentacao" class="required">Tipo da movimentação</label>
                        <x-error-tooltip :campo="'tipo_movimentacao'" />
                    </div>

                    <div class="input-field col s12 m2">
                        <label for="valor" class="required">Valor</label>
                        <input type="text" placeholder="R$ 0.00" name="valor" id="valor" class="validate" required>
                        <x-error-tooltip :campo="'valor'" />
                    </div>

                    <div class="input-field col s12 m8">
                        <label for="observacao" class="required">Observação</label>
                        <input type="text" name="observacao" id="observacao" class="validate" required>
                        <x-error-tooltip :campo="'observacao'" />
                    </div>

                    <div class="input-field col s12 right-align">
                        <a href="{{ url()->previous() }}" class="btn btn-small waves-effect waves-light red accent-4">
                            <i class="material-icons right">arrow_back</i> Salvar
                        </a>

                        <button class="btn btn-small waves-effect waves-light green accent-4">
                            <i class="material-icons right">send</i> Salvar
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#valor').priceFormat({
                prefix: 'R$ ',
                clearPrefix: true,
                centsSeparator: ',',
                thousandsSeparator: '.',
                clearOnEmpty: true,
                allowNegative: false
            });
        });
    </script>
@endpush
