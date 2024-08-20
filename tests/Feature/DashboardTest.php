<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    /**
     * Test getting page.
     */
    public function test_get_dashboard(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertStatus(200);
    }

    /**
     * Test redirection if user not logged in.
     */
    public function test_dashboard_redirect_if_not_logged_in(): void
    {
        $response = $this->get('/dashboard');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }
}
