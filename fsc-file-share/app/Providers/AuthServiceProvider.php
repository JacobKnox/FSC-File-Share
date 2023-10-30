<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Auth::viaRequest('admin', function (Request $request) {
            return $request->user()?->checkRole('admin') ? $request->user() : null;
        });

        Auth::viaRequest('student', function (Request $request) {
            return $request->user()?->checkRole('student') ? $request->user() : null;
        });

        Auth::viaRequest('faculty', function (Request $request) {
            return $request->user()?->checkRole('faculty') ? $request->user() : null;
        });

        Auth::viaRequest('moderator', function (Request $request) {
            return ($request->user()?->checkRole('moderator') || $request->user()?->checkRole('admin')) ? $request->user() : null;
        });

        Auth::viaRequest('alumni', function (Request $request) {
            return $request->user()?->checkRole('alumni') ? $request->user() : null;
        });
    }
}
