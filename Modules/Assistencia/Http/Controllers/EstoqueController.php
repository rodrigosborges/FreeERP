<?php

namespace Modules\Assistencia\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class EstoqueController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
     public function index(){

       return view('assistencia::paginas.estoque');
     }



}
