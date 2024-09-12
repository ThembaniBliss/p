<?php

namespace Tests\Feature\Http\Controllers;

use App\Location;
use App\Owner;
use App\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PropertyController
 */
class PropertyControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $properties = factory(Property::class, 3)->create();

        $response = $this->get(route('property.index'));

        $response->assertOk();
        $response->assertViewIs('property.index');
        $response->assertViewHas('properties');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('property.create'));

        $response->assertOk();
        $response->assertViewIs('property.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PropertyController::class,
            'store',
            \App\Http\Requests\PropertyStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $owner = factory(Owner::class)->create();
        $location = factory(Location::class)->create();
        $description = $this->faker->text;
        $rental_fee = $this->faker->randomFloat(/** double_attributes **/);
        $rental_deposit = $this->faker->randomFloat(/** double_attributes **/);
        $rental_negotiable = $this->faker->randomElement(/** enum_attributes **/);
        $rooms = $this->faker->numberBetween(-10000, 10000);
        $beds = $this->faker->numberBetween(-10000, 10000);
        $accommodation_type = $this->faker->word;

        $response = $this->post(route('property.store'), [
            'owner_id' => $owner->id,
            'location_id' => $location->id,
            'description' => $description,
            'rental_fee' => $rental_fee,
            'rental_deposit' => $rental_deposit,
            'rental_negotiable' => $rental_negotiable,
            'rooms' => $rooms,
            'beds' => $beds,
            'accommodation_type' => $accommodation_type,
        ]);

        $properties = Property::query()
            ->where('owner_id', $owner->id)
            ->where('location_id', $location->id)
            ->where('description', $description)
            ->where('rental_fee', $rental_fee)
            ->where('rental_deposit', $rental_deposit)
            ->where('rental_negotiable', $rental_negotiable)
            ->where('rooms', $rooms)
            ->where('beds', $beds)
            ->where('accommodation_type', $accommodation_type)
            ->get();
        $this->assertCount(1, $properties);
        $property = $properties->first();

        $response->assertRedirect(route('property.index'));
        $response->assertSessionHas('property.id', $property->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $property = factory(Property::class)->create();

        $response = $this->get(route('property.show', $property));

        $response->assertOk();
        $response->assertViewIs('property.show');
        $response->assertViewHas('property');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $property = factory(Property::class)->create();

        $response = $this->get(route('property.edit', $property));

        $response->assertOk();
        $response->assertViewIs('property.edit');
        $response->assertViewHas('property');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PropertyController::class,
            'update',
            \App\Http\Requests\PropertyUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $property = factory(Property::class)->create();
        $owner = factory(Owner::class)->create();
        $location = factory(Location::class)->create();
        $description = $this->faker->text;
        $rental_fee = $this->faker->randomFloat(/** double_attributes **/);
        $rental_deposit = $this->faker->randomFloat(/** double_attributes **/);
        $rental_negotiable = $this->faker->randomElement(/** enum_attributes **/);
        $rooms = $this->faker->numberBetween(-10000, 10000);
        $beds = $this->faker->numberBetween(-10000, 10000);
        $accommodation_type = $this->faker->word;

        $response = $this->put(route('property.update', $property), [
            'owner_id' => $owner->id,
            'location_id' => $location->id,
            'description' => $description,
            'rental_fee' => $rental_fee,
            'rental_deposit' => $rental_deposit,
            'rental_negotiable' => $rental_negotiable,
            'rooms' => $rooms,
            'beds' => $beds,
            'accommodation_type' => $accommodation_type,
        ]);

        $property->refresh();

        $response->assertRedirect(route('property.index'));
        $response->assertSessionHas('property.id', $property->id);

        $this->assertEquals($owner->id, $property->owner_id);
        $this->assertEquals($location->id, $property->location_id);
        $this->assertEquals($description, $property->description);
        $this->assertEquals($rental_fee, $property->rental_fee);
        $this->assertEquals($rental_deposit, $property->rental_deposit);
        $this->assertEquals($rental_negotiable, $property->rental_negotiable);
        $this->assertEquals($rooms, $property->rooms);
        $this->assertEquals($beds, $property->beds);
        $this->assertEquals($accommodation_type, $property->accommodation_type);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $property = factory(Property::class)->create();

        $response = $this->delete(route('property.destroy', $property));

        $response->assertRedirect(route('property.index'));

        $this->assertDeleted($property);
    }
}
