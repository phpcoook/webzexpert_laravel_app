<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\RealEstateProperty;

class RealEstatePropertyApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_lists_all_real_estate_properties()
    {
        RealEstateProperty::factory()->count(3)->create();

        $response = $this->getJson('/api/real-estates');

        $response->assertJsonStructure([
            'data' => [
                '*' => ['id', 'name', 'type', 'city', 'country']
            ]
        ]);
    }

    /** @test */
    public function it_creates_a_real_estate_property()
    {
        $data = [
            'name' => 'Ocean View Condo',
            'real_estate_type' => 'department',
            'street' => 'Sunset Blvd',
            'external_number' => 'A-101',
            'internal_number' => '12B',
            'neighborhood' => 'Seaside',
            'city' => 'Los Angeles',
            'country' => 'US',
            'rooms' => 2,
            'bathrooms' => 1.5,
            'comments' => 'Nice view of the beach'
        ];

        $response = $this->postJson('/api/real-estates', $data);

        $response->assertStatus(201)
            ->assertJsonFragment(['name' => 'Ocean View Condo']);

        $this->assertDatabaseHas('real_estate_properties', ['name' => 'Ocean View Condo']);
    }

    /** @test */
    public function it_shows_a_single_real_estate_property()
    {
        $property = RealEstateProperty::factory()->create();

        $response = $this->getJson("/api/real-estates/{$property->id}");

        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $property->id]);
    }

    /** @test */
    public function it_updates_a_real_estate_property()
    {
        $property = RealEstateProperty::factory()->create([
            'name' => 'Old Name',
        ]);

        $data = ['name' => 'Updated Name'];

        $response = $this->putJson("/api/real-estates/{$property->id}", array_merge(
            $property->toArray(),
            $data
        ));

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Updated Name']);

        $this->assertDatabaseHas('real_estate_properties', ['name' => 'Updated Name']);
    }

    /** @test */
    public function it_soft_deletes_a_real_estate_property()
    {
        $property = RealEstateProperty::factory()->create();

        $response = $this->deleteJson("/api/real-estates/{$property->id}");

        $response->assertStatus(200)
            ->assertJsonFragment(['id' => null]);

        $this->assertSoftDeleted('real_estate_properties', ['id' => $property->id]);
    }
}

