<?php

namespace App\Providers;

use App\Policies\PostPolicy;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use Laravel\Passport\Passport;
use social\company\app\Models\Category;
use social\company\app\Models\Company;
use social\company\app\Models\Service;
use social\datas\app\Models\Project;
use social\datas\app\Models\Skill;
use social\profile\app\Models\Education;
use social\profile\app\Models\Job;
use social\profile\app\Models\Message;
use social\profile\app\Models\Notification;
use social\profile\app\Models\Post;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Post::class => PostPolicy::class,
        Notification::class => PostPolicy::class,
        Message::class => PostPolicy::class,
        Job::class => PostPolicy::class,
        Education::class => PostPolicy::class,
        Project::class => PostPolicy::class,
        Category::class => PostPolicy::class,
        Service::class => PostPolicy::class,
        Company::class => PostPolicy::class,
        Skill::class => PostPolicy::class,
        User::class =>PostPolicy::class

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

    }
}
