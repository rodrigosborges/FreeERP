<?php

namespace Modules\Compra\Tests;

use Tests\TestCase;
use Modules\Compra\Entities\ItemCompra;


class ItemCompraTest extends TestCase
{
    public function testView()
    {
        $this->get('compra/itemCompra')->assertViewIs('compra::item');
        
        $this->get('compra/itemCompra/1/edit')->assertViewIs('compra::formulario_item');

        $this->get('compra/itemCompra/create')->assertViewIs('compra::formulario_item');
    }

       public function testCreateItemCompra(){
        ItemCompra::create([
        'nome_produto' => 'Mouse',
        'valor_estimado' => 40.00,
        'caracteristicas' => "Vermelho sem fio"
        ]);
      
        $this->assertDatabaseHas('item_compra',['nome_produto'=>'Mouse']);
        
    }

    public function testUpdateItemCompra(){
        $response = $this->get('/compra/itemCompra/1/edit',['nome_produto'=>'Teclado']);

        $response->assertStatus(200);

    }

    public function testDeleteItemCompra(){
        $response = $this->delete('/compra/itemCompra/1');

        $response->assertStatus(302);
    }

 
}