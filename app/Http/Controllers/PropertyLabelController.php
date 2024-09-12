<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertyLabelStoreRequest;
use App\Http\Requests\PropertyLabelUpdateRequest;
use App\PropertyLabel;
use Illuminate\Http\Request;

class PropertyLabelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $propertyLabels = PropertyLabel::all();

        return view('propertyLabel.index', compact('propertyLabels'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('propertyLabel.create');
    }

    /**
     * @param \App\Http\Requests\PropertyLabelStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropertyLabelStoreRequest $request)
    {
        $propertyLabel = PropertyLabel::create($request->validated());

        $request->session()->flash('propertyLabel.id', $propertyLabel->id);

        return redirect()->route('propertyLabel.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\PropertyLabel $propertyLabel
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, PropertyLabel $propertyLabel)
    {
        return view('propertyLabel.show', compact('propertyLabel'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\PropertyLabel $propertyLabel
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, PropertyLabel $propertyLabel)
    {
        return view('propertyLabel.edit', compact('propertyLabel'));
    }

    /**
     * @param \App\Http\Requests\PropertyLabelUpdateRequest $request
     * @param \App\PropertyLabel $propertyLabel
     * @return \Illuminate\Http\Response
     */
    public function update(PropertyLabelUpdateRequest $request, PropertyLabel $propertyLabel)
    {
        $propertyLabel->update($request->validated());

        $request->session()->flash('propertyLabel.id', $propertyLabel->id);

        return redirect()->route('propertyLabel.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\PropertyLabel $propertyLabel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, PropertyLabel $propertyLabel)
    {
        $propertyLabel->delete();

        return redirect()->route('propertyLabel.index');
    }
}
