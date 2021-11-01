# Teste Backend - Nano Incub

## Requisitos
- Banco de dados MySql 5.7
- PHP 7.4
- NodeJS 16.9+
- Composer

## Instalação

- Faça o download e extraia o projeto
- Abra a pasta raiz do projeto e renomeie o arquivo **.env.example** para **.env**
- Feito isso, abra o arquivo e configure os parâmetros **DB_HOST**, **DB_PORT**, **DB_DATABASE**, **DB_USERNAME**, **DB_PASSWORD**
- Abra um prompt de comando e navegue até a pasta do projeto e utilize os seguintes comandos -> **composer install** -> **npm install** -> **php artisan key:generate --ansi**
- Crie um banco de dados com o nome que você definiu no parâmetro **DB_DATABASE** do arquivo .env e utilize o comando no cmd **php artisan migrate:fresh --seed**
- Após finalizar o processo de criação do banco de dados, utilize **php artisan serve** para iniciar o servidor laravel e abra a aplicação no navegador.

## Dados de acesso
No processo de migration, serão criados vários usuários.

- Usuário de nivel administrador:
<p><b>Usuário:</b> admin</p>
<p><b>Senha:</b> admin</p>

- Usuário de nivel funcionário:
<p><b>Usuário:</b> funcionario</p>
<p><b>Senha:</b> funcionario</p>
