<?php

namespace App\Http\Controllers;

class Welcome
{
    public function __invoke()
    {
        return view('welcome');
    }
}
