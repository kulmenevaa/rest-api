<?php

namespace Tests\Unit\Api\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp():void {
        parent::setUp();
        $this->refreshDatabase();
    }

    public function testRequestRegister() {
        $response = $this->postJson(route('api.register'));
        $response->assertInvalid(['surname', 'name', 'email', 'password', 'c_password']);
        $response->assertUnprocessable();
    }

    public function testRegister() {
        Artisan::call('passport:install');
        $password = Hash::make('12345678');
        $response = $this->postJson(route('api.register'), [
            'surname'       => $this->faker->firstName(),
            'name'          => $this->faker->lastName(),
            'email'         => $this->faker->unique()->safeEmail(),
            'password'      => $password,
            'c_password'    => $password
        ]);
        $response->assertJson($response->json());
        $response->assertSuccessful();
    }
}
