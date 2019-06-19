<?php

namespace Modules\Calendario\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class CalendarioController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('calendario::index');
    }

    public function eventos()
    {
        $calendario = [
            [
                'id' => 1,
                'title' => 'Curso',
                'start' => '2019-06-20 08:00',
                'end' => '2019-06-22 19:00',
                'backgroundColor' => 'red',
                'borderColor' => 'red',
                'classNames' => 'calendario01'
            ],
            [
                'id' => 2,
                'title' => 'Porra',
                'start' => '2019-06-23',
                'backgroundColor' => 'red',
                'borderColor' => 'red',
                'classNames' => 'calendario01'
            ],
            [
                'id' => 3,
                'title' => 'Porra',
                'start' => '2019-06-15',
                'end' => '2019-06-16',
                'backgroundColor' => 'blue',
                'borderColor' => 'blue',
                'classNames' => 'calendario02'
            ],
            [
                'id' => 4,
                'title' => 'Porra',
                'start' => '2019-06-10',
                'end' => '2019-06-11',
                'backgroundColor' => 'blue',
                'borderColor' => 'blue',
                'classNames' => 'calendario02'
            ]
        ];

        return json_encode($calendario);
    }
}
