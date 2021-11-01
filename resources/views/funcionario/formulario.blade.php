@extends('templates.app')

@section('conteudo')
    <div class="card">
        <div class="card-header">
            <i class="material-icons">person</i> Funcionário
        </div>

        <form method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="input-field col s12 m9">
                        <label for="nome_completo" class="required">Nome</label>
                        <input type="text" name="nome_completo"
                            value="{{ $funcionario->nome_completo ?? old('nome_completo') }}"
                            placeholder="Digite o nome completo do funcionário" class="validate" id="nome_completo"
                            required>
                        <x-error-tooltip :campo="'nome_completo'" />
                    </div>

                    <div class="input-field col s12 m3">
                        <input type="text" id="saldo"
                            value="R$ {{ number_format($funcionario->saldo_atual, 2, ',', '.') }}" disabled>
                        <label for="saldo">Saldo atual</label>
                    </div>
                </div>
            </div>

            <div class="card-header">
                <i class="material-icons left">login</i> Dados de acesso
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="input-field col s12 m4">
                        <label for="login" class="required">Login</label>
                        <input type="text" name="login" id="login" value="{{ $funcionario->login ?? old('login') }}"
                            placeholder="Escolha um nome de usuário" class="validate" required>
                        <x-error-tooltip :campo="'login'" />
                    </div>

                    <div class="input-field col s12 m4">
                        <label for="senha" class="{{ $required ?? null }}">Senha</label>
                        <input type="password" class="validate" name="senha" id="senha" {{ $required ?? null }}>
                        <x-error-tooltip :campo="'senha'" />
                    </div>

                    <div class="input-field col s12 m4">
                        <label for="confirmar_senha" class="{{ $required ?? null }}">Confirmar senha</label>
                        <input type="password" class="validate" {{ $required ?? null }} name="confirmar_senha"
                            id="confirmar_senha">
                        <x-error-tooltip :campo="'confirmar_senha'" />
                    </div>

                    <div class="input-field col s12 right-align">
                        <a href="{{ route('funcionario.pesquisar') }}"
                            class="btn btn-small waves-effect waves-light red accent-4">
                            <i class="material-icons left">arrow_back</i> Voltar
                        </a>

                        <button type="submit" class="btn btn-small waves-effect waves-light green accent-4">
                            <i class="material-icons right">send</i> Salvar
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
