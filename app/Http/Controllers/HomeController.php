<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['breadcrumb'] = ['Dashboard'=>route('app.dashboard')];
        set_page_data('Dashboard','Dashboard');
        return view('home',$data);
    }
}
