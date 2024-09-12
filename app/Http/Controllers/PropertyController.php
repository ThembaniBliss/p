<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertyStoreRequest;
use App\Http\Requests\PropertyUpdateRequest;
use App\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
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
        $properties = Property::all();
       
        return view('property.index', compact('properties'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('property.create');
    }

    /**
     * @param \App\Http\Requests\PropertyStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropertyStoreRequest $request)
    {
        $property = Property::create($request->validated());

        $request->session()->flash('property.prop_id', $property->prop_id);

        return redirect()->route('property.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Property $property
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Property $property)
    {
        return view('property.show', compact('property'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Property $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Property $property)
    {
        return view('property.edit', compact('property'));
    }

    /**
     * @param \App\Http\Requests\PropertyUpdateRequest $request
     * @param \App\Property $property
     * @return \Illuminate\Http\Response
     */
    public function update(PropertyUpdateRequest $request, Property $property)
    {
        $property->update($request->validated());

        $request->session()->flash('property.prop_id', $property->prop_id);

        return redirect()->route('property.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Property $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Property $property)
    {
        $property->delete();

        return redirect()->route('property.index');
    }

    public function approve(Request $request)
    {
        
        $property = Property::find($request->prop_id);        
        $property->prop_approved = $request->prop_approved;
        $property->save();

        return response()->json(['success'=>'Property approved successfully.']);
    }
}
