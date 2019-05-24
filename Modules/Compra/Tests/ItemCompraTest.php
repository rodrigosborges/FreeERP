<?php

namespace Modules\Compra\Tests;

use Tests\TestCase;
use Modules\Compra\Http\Controllers\ItemCompraController;
use Modules\Compra\Entities\ItemCompra;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class ItemCompraTest extends TestCase
{
    public function testView()
    {
        $this->get('compra/itemCompra')->assertViewIs('compra::item');
    }

    public function testCreateItemCompra(){
        ItemCompra::create([
        'nome_produto' => 'Mouse',
        'valor_estimado' => 40.00,
        'caracteristicas' => "Vermelho sem fio"
        ]);
      
        $this->assertDatabaseHas('item_compra',['nome_produto'=>'Mouse']);
        
    }

}
