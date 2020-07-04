<?php

namespace App\Console\Commands;

use App\Actions\CreateLocalDatabase;
use Faker\Generator;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use TitasGailius\Terminal\Terminal;

class StartProject extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:start';
    /**
     * @var Generator
     */
    private Generator $faker;
    /**
     * @var array
     */
    private array $colors;
    /**
     * @var array
     */
    private array $footers;
    /**
     * @var array
     */
    private array $layouts;
    /**
     * @var \Illuminate\Support\Collection
     */
    private $deferred;

    public function __construct(Generator $faker)
    {
        parent::__construct();
        $this->faker = $faker;
        $this->colors = ['gray', 'red', 'orange', 'yellow', 'green', 'teal', 'blue', 'indigo', 'purple', 'pink'];
        $this->footers = ['simple_social'];
        $this->layouts = ['droopy'];
        $this->deferred = collect([]);
    }

    public function handle(): int
    {
        if (!file_exists(__DIR__.'/start.lock') && config('app.env') !== 'testing') {
            return 0;
        }

        // Set up the basics
        $app_name = $this->ask('What is the name of your app?',
            Str::title(last(explode('/', base_path()))));

        $app_url = $this->ask('What is your local development url?', last(explode('/', base_path())).'.test');

        $editors = [
            'Visual Studio Code' => 'code',
            'PhpStorm' => 'pstorm',
            'Sublime Text' => 'sublime',
            'Vim' => 'vim',
            'None Of These' => '',
        ];

        $ide = $this->choice(
            'Which editor will you use to build your app?',
            array_keys($editors),
            'pstorm'
        );

        $env = str_replace(
            ['{APP_NAME}', '{APP_URL}', '{IDE}'],
            ['"'.$app_name.'"', $app_url, $editors[$ide]],
            File::get(__DIR__.'/stubs/env_basic.stub')
        );

        File::put(config('env.env_file'), $env);

        // CREATE AND CONFIGURE LOCAL DATABASE
        $db = $this->choice(
            'What database do you want to use for your local development?',
            ['MySQL', 'sqlite', 'None']
        );

        if ($db == 'sqlite') {
            Terminal::run('touch '.database_path('database.sqlite'));
            File::append(config('env.env_file'), File::get(__DIR__.'/stubs/env_sqlite.stub'));
        }

        if ($db == 'MySQL') {
            $db_username = $this->ask('What is your database username?', 'root');
            $db_password = $this->ask('What is the password for '.$db_username.'?', '');
            $db_database = $this->ask(
                'What do you want to name your database?',
                Str::snake(str_replace('-', ' ', $app_name))
            );

            $env = str_replace(
                ['{DB_USERNAME}', '{DB_PASSWORD}', '{DB_DATABASE}'],
                [$db_username, $db_password, $db_database],
                File::get(__DIR__.'/stubs/env_mysql.stub')
            );

            File::append(config('env.env_file'), $env);

            Config::set('database.db_username', $db_username);
            Config::set('database.db_password', $db_password);


            if (!(new CreateLocalDatabase($db_database))->execute()) {
                $this->error('There was a problem creating the database.');
            }

        }

        if ($this->confirm('Do you want to install Eloquent Sheets?', 'Yes')) {
            $this->deferred->push('composer require grosv/eloquent-sheets');
        }

        if ($this->confirm('Do you want to install Passwordless Login?', 'Yes')) {
            $this->deferred->push('composer require grosv/laravel-passwordless-login');
        }

        if ($this->confirm('Do you want to install Sundial?', 'Yes')) {
            $this->deferred->push('composer require grosv/sundial');
        }

        $this->info('We will now run some commands in the background to finish setting up your app. This might take a few minutes.');

        $this->deferred->each(function ($cmd) {
            Terminal::run($cmd);
        });

        $this->call('key:generate');

        unlink(__DIR__.'/start.lock');

        $this->info('Your app is ready to go. Build something amazing!');

        return 0;
    }
}
