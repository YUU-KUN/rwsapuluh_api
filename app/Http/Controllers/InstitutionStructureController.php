<?php

namespace App\Http\Controllers;

use App\Models\InstitutionStructure;
use Illuminate\Http\Request;

class InstitutionStructureController extends Controller
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
        $institutionStructure = InstitutionStructure::create($input);
        return response()->json([
            'success' => true,
            'message' => 'Success creating institution structure',
            'data' => $institutionStructure
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InstitutionStructure  $institutionStructure
     * @return \Illuminate\Http\Response
     */
    public function show(InstitutionStructure $institutionStructure)
    {
        return response()->json([
            'success' => true,
            'message' => 'Success retrieving institution structure',
            'data' => $institutionStructure
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InstitutionStructure  $institutionStructure
     * @return \Illuminate\Http\Response
     */
    public function edit(InstitutionStructure $institutionStructure)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InstitutionStructure  $institutionStructure
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InstitutionStructure $institutionStructure)
    {
        $institutionStructure->update($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Success updating institution structure',
            'data' => $institutionStructure
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InstitutionStructure  $institutionStructure
     * @return \Illuminate\Http\Response
     */
    public function destroy(InstitutionStructure $institutionStructure)
    {
        $institutionStructure->delete();
        return response()->json([
            'success' => true,
            'message' => 'Success deleting institution structure',
            'data' => $institutionStructure
        ]);
    }
}
