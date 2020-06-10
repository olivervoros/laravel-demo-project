<?php

namespace Tests\Feature;

use App\Passenger;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class FlightReviewAPITest extends TestCase
{

    use RefreshDatabase;

    const API_URL = 'http://localhost:8000/api/flightreviews';

    public function setUp():void
    {
        parent::setUp();
        $this->seed();
        $randomPassenger = Passenger::find(999);
        Passport::actingAs($randomPassenger);
    }


    /** @test */
    public function get_all_flight_reviews_loads_ok()
    {
        $response = $this->get(self::API_URL);
        $response->assertStatus(200);
    }

    /** @test */
    public function get_all_flight_reviews_returns_the_expected_number_of_reviews()
    {
        $response = $this->get(self::API_URL);
        $this->assertCount(17, json_decode($response->getContent()));
    }

    /** @test */
    public function get_all_flight_reviews_returns_the_expected_json_structure()
    {
        $response = $this->get(self::API_URL);

        $structure = [['passenger_id', 'airline', 'flight_number', 'review_points', 'review_title', 'review_body']];
        $response->assertJsonStructure($structure);
    }

    /** @test */
    public function get_existing_flight_review_by_id()
    {
        $response = $this->get(self::API_URL."/9001");
        $response->assertStatus(200);
    }

    /** @test */
    public function successfully_create_a_new_flight_review()
    {
        $post = ['passenger_id' => 999, 'airline' => "Iberia", "flight_number" => 999,
                 'review_points' => 5, "review_title" => "Example Title", 'review_body' => "Example Body"];
        $response = $this->postJson(self::API_URL, $post);
        $response->assertStatus(201);
    }

    /** @test */
    public function failed_to_create_a_new_flight_review_because_of_invalid_data()
    {
        $post = ['passenger_id' => 999, 'airline' => "Iberia", "flight_number" => "This should be an integer",
            'review_points' => 5, "review_title" => "Example Title", 'review_body' => "Example Body"];
        $response = $this->postJson(self::API_URL, $post);
        $response->assertStatus(400);
    }

    /** @test */
    public function failed_to_create_a_new_flight_review_because_of_missing_data()
    {
        $post = ['passenger_id' => 999, "review_title" => "Example Title", 'review_body' => "Example Body"];
        $response = $this->postJson(self::API_URL, $post);
        $response->assertStatus(400);
    }

    /** @test */
    public function the_correct_flight_review_is_created()
    {
        $post = ['passenger_id' => 999, 'airline' => "Oliver Airline", "flight_number" => 999,
            'review_points' => 9, "review_title" => "New Review Title", 'review_body' => "New Review Body"];
        $response = $this->postJson(self::API_URL, $post);
        $response->assertStatus(201)
                 ->assertJson(
                     ['passenger_id' => 999, 'airline' => "Oliver Airline", "flight_number" => 999,
                     'review_points' => 9, "review_title" => "New Review Title",
                         'review_body' => "New Review Body"]);

        $response->assertJsonPath('airline', 'Oliver Airline');
        $response->assertJsonPath('review_points', 9);
        $response->assertJsonPath('review_title', 'New Review Title');

        $response = $this->get(self::API_URL);
        $this->assertCount(18, json_decode($response->getContent()));
    }

    /** @test */
    public function adding_an_extra_field_to_create_flight_review_is_ignored()
    {
        $post = ['passenger_id' => 999, 'airline' => "Oliver Airline", "flight_number" => 999,
            'review_points' => 9, "review_title" => "New Review Title",
            'review_body' => "New Review Body", "extra_field" => "No DB column for this field..."];
        $response = $this->postJson(self::API_URL, $post);
        $response->assertStatus(201)->assertJsonPath('extra_field', null);
    }

    /** @test */
    public function get_non_existing_flight_review_by_id()
    {
        $response = $this->get(self::API_URL."/999999");
        $response->assertStatus(404);
    }

    /** @test */
    public function we_can_update_a_flight_review()
    {
        $post = ['passenger_id' => 999, 'airline' => "Oliver Airline", "flight_number" => 999,
            'review_points' => 9, "review_title" => "New Review Title", 'review_body' => "New Review Body"];
        $response = $this->postJson(self::API_URL, $post);
        $createdId = json_decode($response->getContent(), true)['id'];
        $this->assertIsNumeric($createdId);

        $modifiedData = ['passenger_id' => 999, 'airline' => "Oliver Airline", "flight_number" => 999,
            'review_points' => 9, "review_title" => "Modified Review title", 'review_body' => "New Review Body"];

        $response = $this->put(self::API_URL."/".$createdId, $modifiedData);
        $response->assertStatus(200);
        $response->assertJsonPath('review_title', "Modified Review title");

    }

    /** @test */
    public function updating_a_nox_existent_flight_review_shows_404()
    {
        $response = $this->put(self::API_URL."/999999", []);
        $response->assertStatus(404);
    }

    /** @test */
    public function we_can_delete_a_flight_review()
    {
        $response = $this->delete(self::API_URL."/9004");
        $response->assertStatus(204);

        $response = $this->get(self::API_URL);
        $this->assertCount(16, json_decode($response->getContent()));

        $response = $this->get(self::API_URL."/9004");
        $response->assertStatus(404);
    }
}
