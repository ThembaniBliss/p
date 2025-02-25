<?php

namespace Tests\Feature\Http\Controllers;

use App\Image;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ImageController
 */
class ImageControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $images = factory(Image::class, 3)->create();

        $response = $this->get(route('image.index'));

        $response->assertOk();
        $response->assertViewIs('image.index');
        $response->assertViewHas('images');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('image.create'));

        $response->assertOk();
        $response->assertViewIs('image.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ImageController::class,
            'store',
            \App\Http\Requests\ImageStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $user = factory(User::class)->create();
        $filename = $this->faker->word;
        $type = $this->faker->word;

        $response = $this->post(route('image.store'), [
            'user_id' => $user->id,
            'filename' => $filename,
            'type' => $type,
        ]);

        $images = Image::query()
            ->where('user_id', $user->id)
            ->where('filename', $filename)
            ->where('type', $type)
            ->get();
        $this->assertCount(1, $images);
        $image = $images->first();

        $response->assertRedirect(route('image.index'));
        $response->assertSessionHas('image.id', $image->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $image = factory(Image::class)->create();

        $response = $this->get(route('image.show', $image));

        $response->assertOk();
        $response->assertViewIs('image.show');
        $response->assertViewHas('image');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $image = factory(Image::class)->create();

        $response = $this->get(route('image.edit', $image));

        $response->assertOk();
        $response->assertViewIs('image.edit');
        $response->assertViewHas('image');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ImageController::class,
            'update',
            \App\Http\Requests\ImageUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $image = factory(Image::class)->create();
        $user = factory(User::class)->create();
        $filename = $this->faker->word;
        $type = $this->faker->word;

        $response = $this->put(route('image.update', $image), [
            'user_id' => $user->id,
            'filename' => $filename,
            'type' => $type,
        ]);

        $image->refresh();

        $response->assertRedirect(route('image.index'));
        $response->assertSessionHas('image.id', $image->id);

        $this->assertEquals($user->id, $image->user_id);
        $this->assertEquals($filename, $image->filename);
        $this->assertEquals($type, $image->type);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $image = factory(Image::class)->create();

        $response = $this->delete(route('image.destroy', $image));

        $response->assertRedirect(route('image.index'));

        $this->assertDeleted($image);
    }
}
