# Laravel Boilerplate

This Laravel boilerplate makes it easy for me to launch new projects very quickly. It is a highly opinionated configuration specifically designed for my own use and that of my team. 

![Build Status](https://app.chipperci.com/projects/fbb7d24e-1333-416c-a602-fc96b1a23a72/status/master)
[![StyleCI](https://github.styleci.io/repos/247120757/shield?branch=master)](https://github.styleci.io/repos/247120757)

### Deployment Details

This site is automatically deployed to Laravel Vapor after a successful build at ChipperCI. The `production` environment is the master branch. All feature branches share the `staging` environment, with the most recent successful build pushed to that environment.

### Pre-Launch Configuration

Vapor Preview URL (master branch): [vapor production url](https://gro.sv)

Vapor Preview URL (most recent non-master push): [vapor staging url](https://gro.sv)

Mailtrap Account: username | password

### Database Instance (database-name)

Username: username

Password: password

### Working On This Project

We use a trunk and branch workflow on GitHub for version control. Each issue has its own feature branch, which is immediately draft PRed when it's created so that the work is visible and easy to review as we go. This makes it easier for multiple remote developers to collaborate on solving complex issues and ensures short-lived feature branches (reducing the number of merge conflicts).

Before starting work on this project, run `cp env.local env` in the root of the project to get the required local environment variables set up.

To simplify the workflow for our developers and make things run smoothly, we use a GitHub workflow package for Laravel that provides the following commands for you to use:

`php artisan day:start` Run this command at the beginning of your work day. It will make sure that your codebase is up to date with any changes that came in since you last worked on it and will let you confirm the issue you're working on.

`php artisan issue:start {feature_branch_name}` You never have to run this command by hand. It is triggered when you run `php artisan day:start` and select the issue you want to work on. It makes sure you have the correct branch checked out, that the remote branch corresponding to your local branch exists, and that a draft pull request has been created for the issue.

`php artisan commit {message='WIP'}` Run this command when you have something to commit to your feature branch. It will make sure you're on the correct branch and that the branch is rebased with the latest code so that you don't run into any conflicts. Your work is pushed up to the draft PR so that everyone can see what everyone else is working on. Do this frequently (several times per day). You do not have to pass a message to the command. A work in progress commit message will be automatically used. Though you should pass a message if there's a significant change we should be aware of.

`php artisan issue:close {feature_branch_name}` You never have to run this command by had. It is triggered when you answer "Yes" to whether you want to close the issue when you do a commit. This command does not actually close the issue. It simply pushes up an empty commit with the code owner tagged in the commit message, requesting a review of the code. The issue will be closed when the review is complete and the branch is merged in.

`php artisan day:end` This makes sure that all your work for the day is safely committed to GIT and asks you how many hours you worked for the day. Answer this whether you are being paid hourly or not because it helps us to validate and improve our estimates of how much work a project should take.

