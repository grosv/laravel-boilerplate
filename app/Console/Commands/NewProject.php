<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use TitasGailius\Terminal\Terminal;

class NewProject extends Command
{

    protected $signature = 'project:start';

    private bool $launchChecklist = false;
    private array $colors;
    private array $footers;
    private array $layouts;
    private array $theme;

    public function __construct()
    {
        parent::__construct();
        $this->colors = ['gray', 'red', 'orange', 'yellow', 'green', 'teal', 'blue', 'indigo', 'purple', 'pink'];
        $this->footers = ['simple_social'];
        $this->layouts = ['droopy'];
    }

    public function handle()
    {
        $issues = Terminal::run('gh issue list');

        // Create Launch Checklist Issue if Not Exists
        foreach ($issues->lines() as $line) {
            if (Str::contains((string)$line, 'Launch Checklist')) {
                $this->launchChecklist = true;
            }
        }

        if (!$this->launchChecklist) {
            $response = Terminal::run('gh issue create --title="Launch Checklist" --body="'. File::get(base_path('LAUNCH.md')) .'"');
            if (!$response->ok()) {
                $this->error('Failed to create launch checklist issue!');
                return 1;
            }
            $this->info('Launch checklist issue created.');
        }

        $this->info('The next few questions will create a new config/theme.php file where you can edit the values if you change your mind.');

        $this->theme['color'] = $this->choice('What theme color would you like to use?', ['gray', 'red', 'orange', 'yellow', 'green', 'teal', 'blue', 'indigo', 'purple', 'pink']);

        $this->theme['facebook'] = $this->ask('Facebook Username (optional)');
        $this->theme['instagram'] = $this->ask('Instagram Username (optional)');
        $this->theme['twitter'] = $this->ask('Twitter Username (optional)');
        $this->theme['github'] = $this->ask('GitHub Username (optional)');

        $this->theme['footer'] = $this->choice('Which footer template do you want to use?', $this->footers);

        $this->theme['layout'] = $this->choice('Which theme layout do you want to user?', $this->layouts);

        $this->theme['copyright'] = $this->ask('Who is the copyright holder for this site (optional)?');

        $before = $after = [];
        foreach ($this->theme as $k => $v) {
            $before[] = '{'.$k.'}';
            $after[] = $v;
        }

        $theme = str_replace($before, $after, File::get(__DIR__ . '/theme.stub'));

        File::put(base_path('config/theme.php'), $theme);


    }
}
