<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use File;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organization  = Organization::get();
        return response()->json([
            'success' => true,
            'message' => 'Success getting organization',
            'data' => $organization
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

        if ($request->hasFile('photo')) {
            $filename = time() . '.' . $request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('organization'), $filename);
            $input['photo'] = $filename;
        }
        $organization = Organization::create($input);

        return response()->json([
            'success' => true,
            'message' => 'Success creating organization',
            'data' => $organization
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function show(Organization $organization)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function edit(Organization $organization)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organization $organization)
    { 
        $input = $request->all();
        $input['photo'] = $organization->photo;
        if ($request->hasFile('photo')) {
            $filename = time() . '.' . $request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('organization'), $filename);
            $input['photo'] = $filename;

            // remove old photo
            if ($organization->photo) {
                unlink(public_path('organization') . '/' . $organization->photo);
                File::delete(public_path('organization') . '/' . $organization->photo);
            }
        }
        $organization->update($input);
        return response()->json([
            'success' => true,
            'message' => 'Success updating organization',
            'data' => $organization
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organization $organization)
    {
        $organization->delete();
        // delete photo
        if ($organization->photo) {
            unlink(public_path('organization') . '/' . $organization->photo);
            File::delete(public_path('organization') . '/' . $organization->photo);
        }
        return response()->json([
            'success' => true,
            'message' => 'Success deleting organization',
            'data' => $organization
        ]);
    }
}
