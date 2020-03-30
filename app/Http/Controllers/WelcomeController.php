<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function render()
    {
        $questions = [
            [
                'q' => 'How tall are you?',
                'a' => 'Tall enough',
            ],
            [
                'q' => 'How tall are you?',
                'a' => 'Tall enough',
            ],
            [
                'q' => 'How tall are you?',
                'a' => 'Tall enough',
            ],
            [
                'q' => 'How tall are you?',
                'a' => 'Tall enough',
            ],
        ];

        return view('welcome', compact('questions'));
    }
}
