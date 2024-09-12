<?php

namespace Tests\Feature\Http\Controllers;

use App\Location;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\LocationController
 */
class LocationControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $locations = factory(Location::class, 3)->create();

        $response = $this->get(route('location.index'));

        $response->assertOk();
        $response->assertViewIs('location.index');
        $response->assertViewHas('locations');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('location.create'));

        $response->assertOk();
        $response->assertViewIs('location.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\LocationController::class,
            'store',
            \App\Http\Requests\LocationStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $order = $this->faker->numberBetween(-10000, 10000);
        $title = $this->faker->sentence(4);

        $response = $this->post(route('location.store'), [
            'order' => $order,
            'title' => $title,
        ]);

        $locations = Location::query()
            ->where('order', $order)
            ->where('title', $title)
            ->get();
        $this->assertCount(1, $locations);
        $location = $locations->first();

        $response->assertRedirect(route('location.index'));
        $response->assertSessionHas('location.id', $location->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $location = factory(Location::class)->create();

        $response = $this->get(route('location.show', $location));

        $response->assertOk();
        $response->assertViewIs('location.show');
        $response->assertViewHas('location');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $location = factory(Location::class)->create();

        $response = $this->get(route('location.edit', $location));

        $response->assertOk();
        $response->assertViewIs('location.edit');
        $response->assertViewHas('location');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\LocationController::class,
            'update',
            \App\Http\Requests\LocationUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $location = factory(Location::class)->create();
        $order = $this->faker->numberBetween(-10000, 10000);
        $title = $this->faker->sentence(4);

        $response = $this->put(route('location.update', $location), [
            'order' => $order,
            'title' => $title,
        ]);

        $location->refresh();

        $response->assertRedirect(route('location.index'));
        $response->assertSessionHas('location.id', $location->id);

        $this->assertEquals($order, $location->order);
        $this->assertEquals($title, $location->title);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $location = factory(Location::class)->create();

        $response = $this->delete(route('location.destroy', $location));

        $response->assertRedirect(route('location.index'));

        $this->assertDeleted($location);
    }
}
