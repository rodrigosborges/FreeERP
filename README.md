# Instalação

  A documentação do Laravel é muito bem feita, caso tenham qualquer dúvida, provavelmente tem lá.

  Essa parte da instalação se encontra aqui: https://laravel.com/docs/5.7/installation

  Baixar composer e instalar na pasta do php (só dar next next next):
  https://getcomposer.org/Composer-Setup.exe

```
  abrir um cmd na pasta C:\xampp\htdocs

  composer global require laravel/installer

  laravel new nome_do_projeto (demora um pouco)
```

  executar o comando php artisan serve para rodar o projeto no link localhost:8000
  pode abrir o localhost/nome_do-projeto/public também, funciona do mesmo jeito

# Clonando repositório de um projeto Laravel

  Clonar o projeto na pasta htdocs

  Criar um arquivo .env na raiz do projeto de acordo com o .env.example (o meu é só copiar o conteudo do arquivo)

  Abrir o cmd dentro do projeto

  Executar:

```
  composer update
  php artisan key:generate
```

# Estrutura de pasta

```
  Controllers                     => app/Http/Controllers
  Requests(validação)             => app/Http/Requests
  Models                          => app/
  Arquivos em geral(css,js,imgs)  => public/
  Views                           => resources/views/
  Rotas padrões                   => routes/web
  Migrations                      => database/migrations
```

# Comandos de criação de arquivos

  Gerar um controller
```
php artisan make:controller NomeAquiController
```

  Gerar um controller com estrutura para o route resource
```
php artisan make:controller NomeAquiController --resource
```
    
  Gerar um model
```
php artisan make:model NomeDoModel
```

  Gerar uma request(validação)
```
php artisan make:request NomeDaValidacao
```

  Gerar um middleware(filtro de rotas)
```
php artisan make:middleware NomeDoMiddleware
```

