<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Pool;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome(Request $request)
    {
        if ($request->user()) return redirect()->route('dashboard');
        
        return Inertia::render('Welcome');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard(Request $request)
    {
        $chances_page_label = [];
        $chances_page_data = [];
        $loteria_page_label = [];
        $loteria_page_data = [];

        $chances_last = [];
        $chances_page = [];
        $loteria_last = [];
        $loteria_page = [];

        $responses = Http::pool(fn (Pool $pool) => [
            $pool->as('chances_last')->get('https://integration.jps.go.cr/api/App/chances/last'),
            $pool->as('chances_page')->get('https://integration.jps.go.cr/api/App/chances/page'),
            $pool->as('loteria_last')->get('https://integration.jps.go.cr/api/App/loterianacional/last'),
            $pool->as('loteria_page')->get('https://integration.jps.go.cr/api/App/loterianacional/page'),
        ]);

        if($responses['chances_last']->ok() && $responses['chances_page']->ok() && $responses['loteria_last']->ok() && $responses['loteria_page']->ok()){
            $chances_last = $responses['chances_last']->json();
            $chances_page = $responses['chances_page']->json();
            $loteria_last = $responses['loteria_last']->json();
            $loteria_page = $responses['loteria_page']->json();
        }

        for ($i = 8; $i >= 0; $i--) { 
            $cdate = strtotime($chances_page[$i]['fecha']);
            $ldate = strtotime($chances_page[$i]['fecha']);

            $chances_page_label[] = date("d/m/Y", $cdate);
            $loteria_page_label[] = date("d/m/Y", $ldate);

            $chances_page_data[] = $chances_page[$i]['premios'][0]['numero'];
            $loteria_page_data[] = $loteria_page[$i]['premios'][0]['numero'];
        }

        $data = [
            'chances' => [
                'last' => $chances_last,
                'page' => [
                    'label' => $chances_page_label,
                    'data' => $chances_page_data,
                ],
            ],
            'loteria' => [
                'last' => $loteria_last,
                'page' => [
                    'label' => $loteria_page_label,
                    'data' => $loteria_page_data,
                ],
            ],
        ];

        return Inertia::render('Dashboard', ['data' => $data]);
    }
}