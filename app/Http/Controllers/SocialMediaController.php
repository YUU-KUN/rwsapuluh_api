<?php

namespace App\Http\Controllers;

use App\Models\SocialMedia;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $socialMedia = SocialMedia::all();
        return response()->json([
            'success' => true,
            'message' => 'List Social Media',
            'data' => $socialMedia
        ]);
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
        $validator = \Validator::make($input, [
            'label' => 'required|in:facebook,twitter,instagram',
            'url' => 'required|string',
        ])->validate();

        $socialMedia = SocialMedia::create($input);
        return response()->json([
            'success' => true,
            'message' => 'List Social Media',
            'data' => $socialMedia
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SocialMedia  $socialMedia
     * @return \Illuminate\Http\Response
     */
    public function show(SocialMedia $socialMedia, $id)
    {
        $socialMedia = SocialMedia::find($id);
        return response()->json([
            'success' => true,
            'message' => 'Detail Social Media',
            'data' => $socialMedia
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SocialMedia  $socialMedia
     * @return \Illuminate\Http\Response
     */
    public function edit(SocialMedia $socialMedia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SocialMedia  $socialMedia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SocialMedia $socialMedia, $id)
    {
        $input = $request->all();
        $validator = \Validator::make($input, [
            'label' => 'required|string|in:facebook,twitter,instagram',
            'url' => 'required|string',
            ])->validate();
            
        $socialMedia = SocialMedia::find($id);
        $socialMedia->update($input);
        return response()->json([
            'success' => true,
            'message' => 'List Social Media',
            'data' => $socialMedia
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SocialMedia  $socialMedia
     * @return \Illuminate\Http\Response
     */
    public function destroy(SocialMedia $socialMedia, $id)
    {
        $socialMedia = SocialMedia::find($id);
        $socialMedia->delete();
        return response()->json([
            'success' => true,
            'message' => 'Berhasil menghapus Social Media',
            'data' => $socialMedia
        ]);
    }
}
