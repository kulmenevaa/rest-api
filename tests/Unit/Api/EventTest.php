<?php

namespace Tests\Unit\Api;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\User;
use App\Models\Event;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private $url;
    private $event;
    private $data;

    public function setUp():void {
        parent::setUp();
        Passport::actingAs(User::factory()->create(), ['*']);
        $this->url = route('api.events.index');
        $this->event = Event::factory()->create();
        $this->data = [
            'name'          => $this->faker->name,
            'description'   => $this->faker->text,
            'place'         => $this->faker->address,
            'location'      => $this->faker->title,
            'status'        => rand(0, 1),
            'date_start'    => Carbon::now()->toDateString(),
            'time_start'    => Carbon::now()->toTimeString(),
            'date_end'      => Carbon::now()->toDateString(),
            'time_end'      => Carbon::now()->toTimeString()
        ];
        $this->refreshDatabase();
    }

    public function testRequest() {
        $response = $this->postJson($this->url);
        $response->assertInvalid(['name', 'description', 'place', 'location', 'status', 'date_start', 'time_start', 'date_end', 'time_end']);
        $response->assertUnprocessable();
    }

    public function testIndex() 
    {
        $response = $this->getJson($this->url);
        $response->assertSuccessful();
    }

    public function testCreateEvent() {
        $response = $this->postJson($this->url, $this->data);
        $response->assertJson($response->json())->assertSuccessful();
    }

    public function testUpdateEvent() {
        $response = $this->putJson($this->url . '/' . $this->event->id, $this->data);
        $response->assertJson($response->json())->assertSuccessful();
    }

    public function testDeleteEvent() {
        $response = $this->deleteJson($this->url . '/' . $this->event->id);
        $response->assertSuccessful();
    }
}
