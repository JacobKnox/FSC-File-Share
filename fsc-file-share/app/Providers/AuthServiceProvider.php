<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Report;
use App\Models\File;
use App\Policies\FilePolicy;
use App\Policies\ReportPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Report::class => ReportPolicy::class,
        File::class => FilePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
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
    }
}
