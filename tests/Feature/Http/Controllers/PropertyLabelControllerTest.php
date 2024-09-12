<?php

namespace Tests\Feature\Http\Controllers;

use App\Label;
use App\Property;
use App\PropertyLabel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PropertyLabelController
 */
class PropertyLabelControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $propertyLabels = factory(PropertyLabel::class, 3)->create();

        $response = $this->get(route('property-label.index'));

        $response->assertOk();
        $response->assertViewIs('propertyLabel.index');
        $response->assertViewHas('propertyLabels');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('property-label.create'));

        $response->assertOk();
        $response->assertViewIs('propertyLabel.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PropertyLabelController::class,
            'store',
            \App\Http\Requests\PropertyLabelStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $label = factory(Label::class)->create();
        $property = factory(Property::class)->create();

        $response = $this->post(route('property-label.store'), [
            'label_id' => $label->id,
            'property_id' => $property->id,
        ]);

        $propertyLabels = PropertyLabel::query()
            ->where('label_id', $label->id)
            ->where('property_id', $property->id)
            ->get();
        $this->assertCount(1, $propertyLabels);
        $propertyLabel = $propertyLabels->first();

        $response->assertRedirect(route('propertyLabel.index'));
        $response->assertSessionHas('propertyLabel.id', $propertyLabel->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $propertyLabel = factory(PropertyLabel::class)->create();

        $response = $this->get(route('property-label.show', $propertyLabel));

        $response->assertOk();
        $response->assertViewIs('propertyLabel.show');
        $response->assertViewHas('propertyLabel');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $propertyLabel = factory(PropertyLabel::class)->create();

        $response = $this->get(route('property-label.edit', $propertyLabel));

        $response->assertOk();
        $response->assertViewIs('propertyLabel.edit');
        $response->assertViewHas('propertyLabel');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PropertyLabelController::class,
            'update',
            \App\Http\Requests\PropertyLabelUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $propertyLabel = factory(PropertyLabel::class)->create();
        $label = factory(Label::class)->create();
        $property = factory(Property::class)->create();

        $response = $this->put(route('property-label.update', $propertyLabel), [
            'label_id' => $label->id,
            'property_id' => $property->id,
        ]);

        $propertyLabel->refresh();

        $response->assertRedirect(route('propertyLabel.index'));
        $response->assertSessionHas('propertyLabel.id', $propertyLabel->id);

        $this->assertEquals($label->id, $propertyLabel->label_id);
        $this->assertEquals($property->id, $propertyLabel->property_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $propertyLabel = factory(PropertyLabel::class)->create();

        $response = $this->delete(route('property-label.destroy', $propertyLabel));

        $response->assertRedirect(route('propertyLabel.index'));

        $this->assertDeleted($propertyLabel);
    }
}
