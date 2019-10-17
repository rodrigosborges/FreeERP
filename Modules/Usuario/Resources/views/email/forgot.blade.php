<h1>Olá {{$user->apelido}}</h1>
<p>
    Por favor, clique no link a seguir para resetar a sua senha
    <a href="{{ url('reset_password/'.$user->email.'/'.$code) }}">Resetar senha</a>
</p>