<?php

namespace Tests\Feature\Http\Controllers;

use App\Owner;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\OwnerController
 */
class OwnerControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $owners = factory(Owner::class, 3)->create();

        $response = $this->get(route('owner.index'));

        $response->assertOk();
        $response->assertViewIs('owner.index');
        $response->assertViewHas('owners');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('owner.create'));

        $response->assertOk();
        $response->assertViewIs('owner.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\OwnerController::class,
            'store',
            \App\Http\Requests\OwnerStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $user = factory(User::class)->create();
        $firstname = $this->faker->firstName;
        $surname = $this->faker->word;
        $address = $this->faker->word;
        $image = $this->faker->word;

        $response = $this->post(route('owner.store'), [
            'user_id' => $user->id,
            'firstname' => $firstname,
            'surname' => $surname,
            'address' => $address,
            'image' => $image,
        ]);

        $owners = Owner::query()
            ->where('user_id', $user->id)
            ->where('firstname', $firstname)
            ->where('surname', $surname)
            ->where('address', $address)
            ->where('image', $image)
            ->get();
        $this->assertCount(1, $owners);
        $owner = $owners->first();

        $response->assertRedirect(route('owner.index'));
        $response->assertSessionHas('owner.id', $owner->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $owner = factory(Owner::class)->create();

        $response = $this->get(route('owner.show', $owner));

        $response->assertOk();
        $response->assertViewIs('owner.show');
        $response->assertViewHas('owner');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $owner = factory(Owner::class)->create();

        $response = $this->get(route('owner.edit', $owner));

        $response->assertOk();
        $response->assertViewIs('owner.edit');
        $response->assertViewHas('owner');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\OwnerController::class,
            'update',
            \App\Http\Requests\OwnerUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $owner = factory(Owner::class)->create();
        $user = factory(User::class)->create();
        $firstname = $this->faker->firstName;
        $surname = $this->faker->word;
        $address = $this->faker->word;
        $image = $this->faker->word;

        $response = $this->put(route('owner.update', $owner), [
            'user_id' => $user->id,
            'firstname' => $firstname,
            'surname' => $surname,
            'address' => $address,
            'image' => $image,
        ]);

        $owner->refresh();

        $response->assertRedirect(route('owner.index'));
        $response->assertSessionHas('owner.id', $owner->id);

        $this->assertEquals($user->id, $owner->user_id);
        $this->assertEquals($firstname, $owner->firstname);
        $this->assertEquals($surname, $owner->surname);
        $this->assertEquals($address, $owner->address);
        $this->assertEquals($image, $owner->image);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $owner = factory(Owner::class)->create();

        $response = $this->delete(route('owner.destroy', $owner));

        $response->assertRedirect(route('owner.index'));

        $this->assertDeleted($owner);
    }
}
