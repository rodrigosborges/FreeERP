<?php

namespace Modules\Assistencia\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class AssistenciaController extends Controller
{
     public function index(){

         return view('assistencia::index');
     }

}
