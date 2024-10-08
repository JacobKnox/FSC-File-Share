<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Bug;
use App\Models\Comment;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Report;
use App\Models\File;
use App\Models\Like;
use App\Models\User;
use App\Policies\FilePolicy;
use App\Policies\ReportPolicy;
use App\Policies\BugPolicy;
use App\Policies\UserPolicy;
use App\Policies\CommentPolicy;
use App\Policies\LikePolicy;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Bug::class => BugPolicy::class,
        Comment::class => CommentPolicy::class,
        File::class => FilePolicy::class,
        Like::class => LikePolicy::class,
        Report::class => ReportPolicy::class,
        User::class => UserPolicy::class,
    ];

    protected $actions = [
        'viewAny',
        'view',
        'create',
        'update',
        'delete',
        'restore',
        'forceDelete'
    ];

    protected $models = [
        'bug' => BugPolicy::class,
        'comment' => CommentPolicy::class,
        'like' => LikePolicy::class,
        'file' => FilePolicy::class,
        'report' => ReportPolicy::class,
        'user' => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Auth::viaRequest('admin', function (Request $request) {
            return $request->user()?->checkRoles(['admin']) ? $request->user() : null;
        });

        Auth::viaRequest('student', function (Request $request) {
            return $request->user()?->checkStatus('student') ? $request->user() : null;
        });

        Auth::viaRequest('faculty', function (Request $request) {
            return $request->user()?->checkStatus('faculty') ? $request->user() : null;
        });

        Auth::viaRequest('moderator', function (Request $request) {
            return $request->user()?->checkRoles(['mod', 'admin'], False) ? $request->user() : null;
        });

        Auth::viaRequest('alumni', function (Request $request) {
            return $request->user()?->checkStatus('alumni') ? $request->user() : null;
        });

        foreach($this->actions as $action){
            foreach(array_keys($this->models) as $model){
                Gate::define($action.'-'.$model, [$this->models[$model], $action]);
            }
        }
        Gate::define('push-bug', [BugPolicy::class, 'push']);
        Gate::define('resolve-bug', [BugPolicy::class, 'resolve']);
        Gate::define('filter-file', [FilePolicy::class, 'filter']);
        Gate::define('resolve-report', [ReportPolicy::class, 'resolve']);
    }
}
