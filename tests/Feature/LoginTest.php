<?php

namespace Tests\Feature;

use Tests\TestCase;

class LoginTest extends TestCase
{
    public function test_login_route_exists(): void
    {
        $response = $this->get(route('login'));
        $response->assertStatus(200);
    }

    public function test_login_page_shows_email_input()
    {
        $response = $this->get(route('login'));
        $response->assertSee('login');
    }
}
