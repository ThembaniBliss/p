<?php

namespace App\Http\Controllers;

use App\Http\Requests\LabelStoreRequest;
use App\Http\Requests\LabelUpdateRequest;
use App\Label;
use Illuminate\Http\Request;

class LabelController extends Controller
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
        $labels = Label::all();

        return view('label.index', compact('labels'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('label.create');
    }

    /**
     * @param \App\Http\Requests\LabelStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(LabelStoreRequest $request)
    {
        $label = Label::create($request->validated());

        $request->session()->flash('label.id', $label->label_id);

        return redirect()->route('label.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Label $label
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Label $label)
    {
        return view('label.show', compact('label'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Label $label
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Label $label)
    {
        return view('label.edit', compact('label'));
    }

    /**
     * @param \App\Http\Requests\LabelUpdateRequest $request
     * @param \App\Label $label
     * @return \Illuminate\Http\Response
     */
    public function update(LabelUpdateRequest $request, Label $label)
    {
        $label->update($request->validated());

        $request->session()->flash('label.id', $label->label_id);

        return redirect()->route('label.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Label $label
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Label $label)
    {
        $label->delete();

        return redirect()->route('label.index');
    }
}
