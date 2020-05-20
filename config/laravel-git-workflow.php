<?php

return [
    'branch_prefix' => env('LGW_BRANCH_PREFIX', ''),
    'project_owner' => env('LGW_PROJECT_OWNER', ''),
    'github_user'   => env('LGW_GITHUB_USER', ''),
    'wip'           => env('LGW_WIP', 'WIP'),
    'env'           => base_path('.env'),
    'composer_json' => base_path('/composer.json'),
    'repositories'  => [
        'stubby' => [
            'path' => env('LGW_REPOS_STUBBY_PATH', '../../../Packages/grosv/stubby'),
            'git' => 'https://github.com/grosv/stubby',
            'version' => 'dev-master',
        ],
        'laravel-git-workflow' => [
            'path' => env('LGW_REPOS_LGW_PATH', '../../../Packages/grosv/laravel-git-workflow'),
            'version' => '^1.0',
        ],
        'eloquent-sheets' => [
            'path' => env('LGW_REPOS_SHEETS_PATH', '../../../Packages/grosv/eloquent-sheets'),
            'version' => '^1.2',
        ],
        'laravel-passwordless-login' => [
            'path' => env('LGW_REPOS_PASSWORDLESS_PATH', '../../../Packages/grosv/laravel-passwordless-login'),
            'version' => '^1.2',
        ]
    ],
];
