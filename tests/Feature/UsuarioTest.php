<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Usuario
 extends TestCase /*TestCase é a classe base que o laravel utiliza para realizar testes*/
{
/*Método para a criação de Usuario*/
public function testCreateUser()
{
    /*Criação de um usuário*/
    \Modules\ControleUsuario\Entities\Usuario::create([
        'name' => 'Admin User',
        'email'=> 'admin@admin.com',
        'password'=> bcrypt(123456)
    ]);

    /*verificação no BD se na tabela usuario existe um camarada cujo o nome é Admin User*/
    $this->assertDatabaseHas('usuario',['name'=>'Admin User']);
}
  
    
    


}
