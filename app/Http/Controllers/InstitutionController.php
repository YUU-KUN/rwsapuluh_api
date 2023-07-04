<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use Illuminate\Http\Request;

class InstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $institution = Institution::orderBy('name', 'asc')->get();
        return response()->json([
            'success' => true,
            'message' => 'Success getting institution',
            'data' => $institution
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
        $institution = Institution::create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Success creating institution',
            'data' => $institution
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function show(Institution $institution)
    {
        // order structures by name
        // $institution = $institution->Structures->orderBy('name', 'asc')->get();
        return response()->json([
            'success' => true,
            'message' => 'Success getting institution',
            'data' => $institution->load('Structures', 'Galleries')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function edit(Institution $institution)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Institution $institution)
    { 
        $institution->update($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Success updating institution',
            'data' => $institution
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function destroy(Institution $institution)
    {
        $institution->delete();
        return response()->json([
            'success' => true,
            'message' => 'Success deleting institution',
            'data' => $institution
        ]);
    }
}
