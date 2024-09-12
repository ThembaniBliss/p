<?php

namespace Tests\Feature\Http\Controllers;

use App\Label;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\LabelController
 */
class LabelControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $labels = factory(Label::class, 3)->create();

        $response = $this->get(route('label.index'));

        $response->assertOk();
        $response->assertViewIs('label.index');
        $response->assertViewHas('labels');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('label.create'));

        $response->assertOk();
        $response->assertViewIs('label.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\LabelController::class,
            'store',
            \App\Http\Requests\LabelStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;
        $value = $this->faker->word;
        $icon = $this->faker->word;

        $response = $this->post(route('label.store'), [
            'name' => $name,
            'value' => $value,
            'icon' => $icon,
        ]);

        $labels = Label::query()
            ->where('name', $name)
            ->where('value', $value)
            ->where('icon', $icon)
            ->get();
        $this->assertCount(1, $labels);
        $label = $labels->first();

        $response->assertRedirect(route('label.index'));
        $response->assertSessionHas('label.id', $label->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $label = factory(Label::class)->create();

        $response = $this->get(route('label.show', $label));

        $response->assertOk();
        $response->assertViewIs('label.show');
        $response->assertViewHas('label');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $label = factory(Label::class)->create();

        $response = $this->get(route('label.edit', $label));

        $response->assertOk();
        $response->assertViewIs('label.edit');
        $response->assertViewHas('label');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\LabelController::class,
            'update',
            \App\Http\Requests\LabelUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $label = factory(Label::class)->create();
        $name = $this->faker->name;
        $value = $this->faker->word;
        $icon = $this->faker->word;

        $response = $this->put(route('label.update', $label), [
            'name' => $name,
            'value' => $value,
            'icon' => $icon,
        ]);

        $label->refresh();

        $response->assertRedirect(route('label.index'));
        $response->assertSessionHas('label.id', $label->id);

        $this->assertEquals($name, $label->name);
        $this->assertEquals($value, $label->value);
        $this->assertEquals($icon, $label->icon);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $label = factory(Label::class)->create();

        $response = $this->delete(route('label.destroy', $label));

        $response->assertRedirect(route('label.index'));

        $this->assertDeleted($label);
    }
}
