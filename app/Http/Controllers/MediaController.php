<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Traits\MediaTrait;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    use MediaTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // Get all media records to pass to the view
        $medias = Media::all();

        // Return the view and pass all media records
        return view('mediaindex', compact('medias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $medias = Media::all();
        return view('media', compact('medias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!$request->hasFile('file')) {
            return back()->withErrors(['file' => 'No file uploaded.']);
        }

        $media = $this->storeMedia($request->file('file'));

        Media::create([
            'name' => $media['name'],
            'mimetype' => $media['mimetype'],
            'path' => $media['path'],
            'extension' => $media['extension']
        ]);
        return redirect()->route('media');
    }

    /**
     * Display the specified resource.
     */
    public function show(Media $media)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Media $media)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Media $media)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $media = Media::find($id);
        $media->delete();

        return back();
    }
}
