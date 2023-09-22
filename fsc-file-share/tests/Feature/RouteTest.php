<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class RouteTest extends TestCase
{
    public function test_auth_routes(): void
    {
        $user = User::findOrFail(2);
        $guestRoutes = ['/login', '/signup'];
        $userRoutes = ['/users/2'];
        // Testing whether the user can access guest routes when authenticated
        foreach ($guestRoutes as $route) {
            $response = $this->actingAs($user)->get($route);
            $response->assertLocation("http://localhost");
        }
        // Testing whether the user can access user routes when authenticated AND whether a guest can access these routes
        foreach ($userRoutes as $route) {
            $response = $this->actingAs($user)->get($route);
            $response->assertLocation("http://localhost" . $route);
            $response = $this->get($route);
            $response->assertLocation("http://localhost");
        }
    }
}
