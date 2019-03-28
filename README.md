# PADRONIZAÇÃO PROJETO INTEGRADO I

## Banco de dados

Banco terceira forma normal

Tabelas no singular

Todos os campos e tabelas em letras minúsculas 

Separação por underline

Chave estrangeira nomedatabela_id

Chave primária id (auto_increment)

Escrever em português 

Tabelas geradas de relacionamento n..n (tabela1_has_tabela2)


## Código

Variáveis em camel case (nomeUsuario, dataDeAdmissao)

Nome de modelos no singular e primeira letra maiúscula

Rotas REST (Route Resource)


## Alertas (mensagens de sucesso, alerta e erro)

●	Sucesso: “success”

●	Alerta: “warning”

●	Erro: “error”

Exemplos no Laravel 5.*:

### 1 - Enviando a variável de sessão com uma mensagem para a view anterior (o template principal ja está exibindo caso a session exista):
 ```
    return back()->with('success','O usuário foi cadastrado com sucesso!');
    return back()->with('warning','Acesso negado!');
    return back()->with('error','Houve um erro no servidor. Tente novamente!');
 ```
 
 ## Utilizando o Laravel-Modules
 
 ### Criando o módulo
 ```
    php artisan module:make <nome_do_modulo>
 ```
 
 ### Comandos de criação de arquivos
 ```
    php artisan module:make-migration <nome_do_migration> <nome_do_modulo>
    php artisan module:make-controller <nome_do_controller> <nome_do_modulo>
    php artisan module:make-model <nome_do_model> <nome_do_modulo>
 ```
 
 ### Utilizando os comandos relacionados ao migrate no modulo
 ```
    php artisan module:migrate <nome_do_modulo>
    php artisan module:migrate-rollback <nome_do_modulo>
    php artisan module:migrate-refresh <nome_do_modulo>
    php artisan module:migrate-reset <nome_do_modulo>
 ```
 
 ### Outros comandos de criação de arquivos:
 https://nwidart.com/laravel-modules/v4/advanced-tools/artisan-commands
