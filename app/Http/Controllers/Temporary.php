<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Temporary
{
    public function panic()
    {
        abort_if(config('env.app_launched'), 500);
        return response()->noContent();
    }
}
