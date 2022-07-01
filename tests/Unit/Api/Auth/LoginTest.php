<?php

namespace Tests\Unit\Api\Auth;

use Tests\TestCase;
use App\Models\User;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private $user;

    public function setUp():void {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->refreshDatabase();
    }

    public function testRequestLogin() {
        $response = $this->postJson(route('api.login'));
        $response->assertInvalid(['email', 'password']);
        $response->assertUnprocessable();
    }

    public function testLoginNotFound() {
        $response = $this->postJson(route('api.login'), [
            'email'     => $this->user->email,
            'password'  => 'test'
        ]);
        $response->assertUnauthorized();
    }

    public function testLogin() {
        Artisan::call('passport:install');
        $response = $this->postJson(route('api.login'), [
            'email'     => $this->user->email,
            'password'  => '12345678'
        ]);
        $response->assertJson($response->json());
        $response->assertSuccessful();
    }

    public function testLogout() {
        Passport::actingAs($this->user, ['*']);
        $token = $this->user->accessToken;
        $response = $this->postJson(route('api.logout'), [], [
            'Authorization' => 'Bearer ' . $token
        ]);
        $response->assertJson($response->json());
        $response->assertSuccessful();
    }
}
