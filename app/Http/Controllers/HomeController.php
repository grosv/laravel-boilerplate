<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(): Response
    {
        return view('home');
    }
}
