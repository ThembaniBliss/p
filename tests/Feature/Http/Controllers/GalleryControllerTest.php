<?php

namespace Tests\Feature\Http\Controllers;

use App\Gallery;
use App\Image;
use App\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\GalleryController
 */
class GalleryControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $galleries = factory(Gallery::class, 3)->create();

        $response = $this->get(route('gallery.index'));

        $response->assertOk();
        $response->assertViewIs('gallery.index');
        $response->assertViewHas('galleries');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('gallery.create'));

        $response->assertOk();
        $response->assertViewIs('gallery.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\GalleryController::class,
            'store',
            \App\Http\Requests\GalleryStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $image = factory(Image::class)->create();
        $property = factory(Property::class)->create();
        $main = $this->faker->word;

        $response = $this->post(route('gallery.store'), [
            'image_id' => $image->id,
            'property_id' => $property->id,
            'main' => $main,
        ]);

        $galleries = Gallery::query()
            ->where('image_id', $image->id)
            ->where('property_id', $property->id)
            ->where('main', $main)
            ->get();
        $this->assertCount(1, $galleries);
        $gallery = $galleries->first();

        $response->assertRedirect(route('gallery.index'));
        $response->assertSessionHas('gallery.id', $gallery->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $gallery = factory(Gallery::class)->create();

        $response = $this->get(route('gallery.show', $gallery));

        $response->assertOk();
        $response->assertViewIs('gallery.show');
        $response->assertViewHas('gallery');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $gallery = factory(Gallery::class)->create();

        $response = $this->get(route('gallery.edit', $gallery));

        $response->assertOk();
        $response->assertViewIs('gallery.edit');
        $response->assertViewHas('gallery');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\GalleryController::class,
            'update',
            \App\Http\Requests\GalleryUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $gallery = factory(Gallery::class)->create();
        $image = factory(Image::class)->create();
        $property = factory(Property::class)->create();
        $main = $this->faker->word;

        $response = $this->put(route('gallery.update', $gallery), [
            'image_id' => $image->id,
            'property_id' => $property->id,
            'main' => $main,
        ]);

        $gallery->refresh();

        $response->assertRedirect(route('gallery.index'));
        $response->assertSessionHas('gallery.id', $gallery->id);

        $this->assertEquals($image->id, $gallery->image_id);
        $this->assertEquals($property->id, $gallery->property_id);
        $this->assertEquals($main, $gallery->main);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $gallery = factory(Gallery::class)->create();

        $response = $this->delete(route('gallery.destroy', $gallery));

        $response->assertRedirect(route('gallery.index'));

        $this->assertDeleted($gallery);
    }
}
