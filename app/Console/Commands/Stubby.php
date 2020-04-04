<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Stubby extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'new {thing} {name}';


    public function __construct()
    {
        parent::__construct();
    }


    public function handle(): int
    {
        $this->thing = $this->argument['thing'];
        $this->name = Str::studly($this->argument['name']);

        if (empty($this->thing)) {
            $this->error('What are you trying to build?');
            return 1;
        }
        if (empty($this->name)) {
            $this->error('What are you trying to name the thing you are trying to build?');
        }
        switch($this->thing) {
            case 'controller':
                if (Str::endsWith($this->name, 'Controller')) {
                    $this->name .= 'Controller';
                }
                $this->call('make:controller', ['name' => $this->name]);
                $this->call('make:test', ['name' => $this->name . 'Test']);
                File::put(resource_path('views/'.Str::snake(Str::replaceLast('Controller', '', $this->name))), "@extends('layouts.app')\n@section('content')\n\n@endsection");
            break;
        }
        return 0;
    }
}
