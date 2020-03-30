<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class NewProject extends Command
{

    protected $signature = 'project:start';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Ready to build the command');
    }
}
