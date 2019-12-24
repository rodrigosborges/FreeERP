## FreeERP - Módulo de Assistência Técnica
Software para gerenciamento de ordens de serviço para uma assistência técnica de smartphones.

## Features
- PHP (Laravel)
- MySQL
- Javascript

## Getting started
1. Clonar repositório: https://github.com/rodrigosborges/FreeERP.git dentro do diretório do seu servidor Apache <br>
&nbsp;&nbsp;&nbsp;&nbsp;1.1. Exemplo, caso utilize o XAMPP:  C:\xampp\htdocs\FreeERP
2. Renomear arquivo .env.example para .env 
3. Criar um novo banco de dados chamado 'freeerp' 
4. Abrir o terminal de comandos (de sua escolha) no diretorio da aplicação. 
&nbsp;&nbsp;&nbsp;&nbsp;Executar: <br>
&nbsp;&nbsp;&nbsp;&nbsp;4.1. 'git checkout assistencia_tecnica' (para acessar o módulo)<br>
&nbsp;&nbsp;&nbsp;&nbsp;4.2. 'compser update' <br>
&nbsp;&nbsp;&nbsp;&nbsp;4.3. php artisan key:generate <br>
&nbsp;&nbsp;&nbsp;&nbsp;4.4. php artisan migrate --seed <br>
5. Acessar: http://localhost/FreeERP/assistencia/public 
