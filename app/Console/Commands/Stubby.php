<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use TitasGailius\Terminal\Terminal;

class Stubby extends Command
{
    protected $signature = 'new {thing} {name}';

    private Collection $files;

    public function __construct()
    {
        parent::__construct();
        $this->files = collect([]);
    }


    public function handle(): int
    {
        $this->thing = $this->argument('thing');
        $this->name = Str::studly($this->argument('name'));

        if (empty($this->thing)) {
            $this->error('What are you trying to build?');
            return 1;
        }
        if (empty($this->name)) {
            $this->error('What are you trying to name the thing you are trying to build?');
            return 1;
        }
        switch($this->thing) {
            case 'action':
                    $stub = File::get(base_path('stubs/action.stub'));
                    File::put(app_path('Actions/'.$this->name).'.php', str_replace('{{ class }}', $this->name, $stub));
                    $this->files->push(app_path('/Actions/'.$this->name.'.php'));
                    $this->info('Action created successfully.');
                    $this->call('make:test', ['name' => 'Action' . $this->name . 'Test', '--unit' => true]);
                    $this->files->push('tests/Unit/Action'.$this->name.'Test.php');
                break;
            case 'command':
                $this->call('make:command', ['name' => $this->name]);
                $this->files->push(app_path('Console/Commands/'.$this->name.'.php'));
                $this->call('make:test', ['name' => 'Command' . $this->name . 'Test', '--unit' => true]);
                $this->files->push('tests/Unit/Command'.$this->name.'Test.php');
                break;
            case 'controller':
                $stub = File::get(base_path('stubs/test.mojito.stub'));
                $stub = str_replace('{{ namespace }}', 'Tests\\Unit', $stub);
                $stub = str_replace('{{ class }}', 'Blade'.$this->name.'Test', $stub);
                File::put(base_path('tests/Unit/Blade'.$this->name.'Test.php'), $stub);
                $this->files->push(base_path('tests/Unit/Blade'.$this->name.'Test.php'));
                $this->info('Mojito test created successfully.');
                if (!Str::endsWith($this->name, 'Controller')) {
                    $this->name .= 'Controller';
                }
                $this->call('make:controller', ['name' => $this->name]);
                $this->files->push(app_path('Http/Controllers/'.$this->name.'.php'));
                $this->call('make:test', ['name' => $this->name . 'Test']);
                $this->files->push('tests/Feature/'.$this->name.'Test.php');
                File::put(resource_path('views/'.Str::snake(Str::replaceLast('Controller', '', $this->name)).'.blade.php'), "@extends('layouts.app')\n@section('content')\n\n@endsection");
                $this->files->push(resource_path('views/'.Str::snake(str_replace('Controller', '', $this->name)).'.blade.php'));
                $this->info('Template created successfully.');
                break;
            case 'livewire':
                $this->call('make:livewire', ['name' => Str::slug($this->name)]);
                $this->files->push(app_path('Http/Livewire/'.$this->name.'.php'));
                $this->call('make:test', ['name' => 'Livewire'.$this->name.'Test', '--unit' => true]);
                $this->files->push(base_path('tests/Unit/Livewire'.$this->name.'Test.php'));
                break;
            case 'model':
                $this->call('make:model', ['name' => $this->name, '-m' => true]);
                $this->call('make:factory', ['name' => $this->name.'Factory', '--model' => 'App\\'.$this->name]);

                break;


        }

        $this->files->each(function($file) {
            Terminal::run("pstorm $file");
        });
        return 0;
    }
}
