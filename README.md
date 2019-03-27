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

### 1 - Enviando a variável de sessão com uma mensagem para a view anterior:
 ```
    return back()->with('success','O usuário foi cadastrado com sucesso!');
    return back()->with('warning','Acesso negado!');
    return back()->with('error','Houve um erro no servidor. Tente novamente!');
 ```

### 2 - Exibindo a mensagem na view:
 ```
    @if( isset (Session::get('success')))
        <div class="alert alert success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
 ```
 
