<?php

namespace Tests\Unit\Api;

use Tests\TestCase;
use App\Models\News;
use App\Models\User;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NewsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private $url;
    private $news;
    private $data;

    public function setUp():void {
        parent::setUp();
        Passport::actingAs(User::factory()->create(),['*']);
        $this->url = route('api.news.index');
        $this->news = News::factory()->create();
        $this->data = [
            'title'         => $this->faker->name,
            'description'   => $this->faker->text
        ];
        $this->refreshDatabase();
    }

    public function testRequestNews() {
        $response = $this->postJson($this->url);
        $response->assertInvalid(['title', 'description']);
        $response->assertUnprocessable();
    }

    public function testIndex() 
    {
        $response = $this->getJson($this->url);
        $response->assertSuccessful();
    }

    public function testCreateNews() {
        $response = $this->postJson($this->url, $this->data);
        $response->assertJson($response->json())->assertSuccessful();
    }
   
    public function testUpdateNews() {
        $response = $this->putJson($this->url . '/' . $this->news->id, $this->data);
        $response->assertJson($response->json())->assertSuccessful();
    }

    public function testDeleteNews() {
        $response = $this->deleteJson($this->url . '/' . $this->news->id);
        $response->assertSuccessful();
    }
}
