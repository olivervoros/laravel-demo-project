<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FlightReviewAPITest extends TestCase
{

    use RefreshDatabase;

    public function setUp():void
    {
        parent::setUp();
        $this->seed();
    }


    /** @test */
    public function get_all_flight_reviews_loads_ok_and_returns_200()
    {
        $response = $this->get('http://localhost:8000/api/flightreviews');
        $response->assertOk();
        $response->assertStatus(200);
    }

    /** @test */
    public function get_all_flight_reviews_returns_the_expected_number_of_reviews()
    {
        $response = $this->get('http://localhost:8000/api/flightreviews');
        $this->assertCount(1000, json_decode($response->getContent()));
    }

    /** @test */
    public function get_all_flight_reviews_returns_the_expected_json_structure()
    {
        $response = $this->get('http://localhost:8000/api/flightreviews');

        $structure = [['passenger_id', 'airline', 'flight_number', 'review_points', 'review_title', 'review_body']];
        $response->assertJsonStructure($structure);
    }
}
