<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserFeatureTest extends TestCase
{
    public function test_user_can_login()
{

    $user = User::factory()->create([
        'email' => 'user@example.com',
        'password' => bcrypt('password123'),
    ]);


    $response = $this->post('/login', [
        'email' => 'user@example.com',
        'password' => 'password123',
    ]);


    $response->assertRedirect('/home');
    $this->assertAuthenticatedAs($user);
}

}
