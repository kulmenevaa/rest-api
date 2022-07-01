<?php

namespace Tests\Unit\Api;

use Tests\TestCase;
use App\Models\User;
use App\Models\EventTheme;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventThemeTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private $url;
    private $theme;
    private $data;

    public function setUp():void {
        parent::setUp();
        Passport::actingAs(User::factory()->create(), ['*']);
        $this->url = route('api.themes.index');
        $this->theme = EventTheme::factory()->create();
        $this->data = [
            'name' => $this->faker->name
        ];
        $this->refreshDatabase();
    }

    public function testRequestThemeEvent() {
        $response = $this->postJson($this->url);
        $response->assertInvalid(['name']);
        $response->assertUnprocessable();
    }

    public function testIndex() 
    {
        $response = $this->getJson($this->url);
        $response->assertSuccessful();
    }

    public function testCreateThemeEvent() {
        $response = $this->postJson($this->url, $this->data);
        $response->assertJson($response->json())->assertSuccessful();
    }
   
    public function testUpdateThemeEvent() {
        $response = $this->putJson($this->url . '/' . $this->theme->id, $this->data);
        $response->assertJson($response->json())->assertSuccessful();
    }

    public function testDeleteThemeEvent() {
        $response = $this->deleteJson($this->url . '/' . $this->theme->id);
        $response->assertSuccessful();
    }
}
