<?php

namespace App\Http\Controllers;

use App\Models\InstitutionGallery;
use Illuminate\Http\Request;

class InstitutionGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        if ($request->hasFile('image')) {
            $filename = time() . '-' . $request->image->getClientOriginalName();
            $request->image->move(public_path('gallery'), $filename);
            $input['image'] = $filename;
        }
        $institutionGallery = InstitutionGallery::create($input);
        return response()->json([
            'success' => true,
            'message' => 'Success creating institution gallery',
            'data' => $institutionGallery
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InstitutionGallery  $institutionGallery
     * @return \Illuminate\Http\Response
     */
    public function show(InstitutionGallery $institutionGallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InstitutionGallery  $institutionGallery
     * @return \Illuminate\Http\Response
     */
    public function edit(InstitutionGallery $institutionGallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InstitutionGallery  $institutionGallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InstitutionGallery $institutionGallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InstitutionGallery  $institutionGallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(InstitutionGallery $institutionGallery)
    {
        $institutionGallery->delete();
        return response()->json([
            'success' => true,
            'message' => 'Success deleting institution gallery',
            'data' => $institutionGallery
        ]);
    }
}
