<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Gluten extends Command
{
    protected $signature = 'gluten {total}';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): int
    {
        $this->info($this->argument('total') * .88 - ($this->argument('total') * .857142857));

        return 0;
    }
}
