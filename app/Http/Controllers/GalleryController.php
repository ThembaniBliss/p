<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Http\Requests\GalleryStoreRequest;
use App\Http\Requests\GalleryUpdateRequest;
use Illuminate\Http\Request;

class GalleryController extends Controller
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
        $galleries = Gallery::all();

        return view('gallery.index', compact('galleries'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('gallery.create');
    }

    /**
     * @param \App\Http\Requests\GalleryStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryStoreRequest $request)
    {
        $gallery = Gallery::create($request->validated());

        $request->session()->flash('gallery.id', $gallery->gallery_id);

        return redirect()->route('gallery.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Gallery $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Gallery $gallery)
    {
        return view('gallery.show', compact('gallery'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Gallery $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Gallery $gallery)
    {
        return view('gallery.edit', compact('gallery'));
    }

    /**
     * @param \App\Http\Requests\GalleryUpdateRequest $request
     * @param \App\Gallery $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(GalleryUpdateRequest $request, Gallery $gallery)
    {
        $gallery->update($request->validated());

        $request->session()->flash('gallery.id', $gallery->gallery_id);

        return redirect()->route('gallery.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Gallery $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Gallery $gallery)
    {
        $gallery->delete();

        return redirect()->route('gallery.index');
    }
}
