<?php

namespace App\Http\Controllers;

use App\Http\Requests\OwnerStoreRequest;
use App\Http\Requests\OwnerUpdateRequest;
use App\Owner;
use Illuminate\Http\Request;

class OwnerController extends Controller
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
        $owners = Owner::all();

        return view('owner.index', compact('owners'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('owner.create');
    }

    /**
     * @param \App\Http\Requests\OwnerStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OwnerStoreRequest $request)
    {
        $owner = Owner::create($request->validated());

        $request->session()->flash('owner.id', $owner->owner_id);

        return redirect()->route('owner.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Owner $owner
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Owner $owner)
    {
        return view('owner.show', compact('owner'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Owner $owner
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Owner $owner)
    {
        return view('owner.edit', compact('owner'));
    }

    /**
     * @param \App\Http\Requests\OwnerUpdateRequest $request
     * @param \App\Owner $owner
     * @return \Illuminate\Http\Response
     */
    public function update(OwnerUpdateRequest $request, Owner $owner)
    {
        $owner->update($request->validated());

        $request->session()->flash('owner.id', $owner->owner_id);

        return redirect()->route('owner.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Owner $owner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Owner $owner)
    {
        $owner->delete();

        return redirect()->route('owner.index');
    }
}
