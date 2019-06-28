<?php

namespace Modules\Calendario\Http\Controllers;

use Illuminate\Routing\Controller;

class CalendarioController extends Controller
{
    public function index()
    {
        return view('calendario::index');
    }
}
