<?php

namespace App\Providers;

use App\Policies\PostPolicy;
use App\Models\Post;
use App\Policies\CommentPolicy;
use App\Models\Comment;
use App\Policies\VotePolicy;
use App\Models\Vote;
use App\Policies\ReportPolicy;
use App\Models\Report;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Post::class => PostPolicy::class,
        Comment::class => CommentPolicy::class,
        Vote::class => VotePolicy::class,
        Report::class => ReportPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
