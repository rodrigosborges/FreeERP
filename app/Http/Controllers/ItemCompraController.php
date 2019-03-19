<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class ItemCompraController extends Controller
{
    
    public function novo(){
        return view('item.formulario');
    }

}
