<?php

namespace App\Http\Controllers;

use App\Models\OrganizationImage;
use Illuminate\Http\Request;

class OrganizationImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'data' => OrganizationImage::all(),
            'message' => 'Berhasil mendapatkan data gambar organisasi',
            'success' => true
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
        $filename = time().'.'.$request->image->extension();
        $request->image->move(public_path('organization'), $filename);
        $input['image'] = $filename;

        $organizationImage = OrganizationImage::create($input);
        return response()->json([
            'data' => $organizationImage,
            'message' => 'Berhasil menambahkan gambar organisasi',
            'success' => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrganizationImage  $organizationImage
     * @return \Illuminate\Http\Response
     */
    public function show(OrganizationImage $organizationImage)
    {
        return response()->json([
            'data' => $organizationImage,
            'message' => 'Berhasil mendapatkan data gambar organisasi',
            'success' => true
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrganizationImage  $organizationImage
     * @return \Illuminate\Http\Response
     */
    public function edit(OrganizationImage $organizationImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrganizationImage  $organizationImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrganizationImage $organizationImage)
    {
        $input = $request->all();

        if ($request->hasFile('image')) {
            $filename = time().'.'.$request->image->extension();
            $request->image->move(public_path('organization'), $filename);
            $input['image'] = $filename;
    
            // remove old image
            $oldImage = $organizationImage->image;
            $oldImagePath = public_path('organization').'/'.$oldImage;
            if (file_exists($oldImagePath)) {
                File::delete($oldImagePath);
            }
        } else {
            $input['image'] = $organizationImage->image;
        }

        $organizationImage->update($input);
        
        return response()->json([
            'data' => $organizationImage,
            'message' => 'Berhasil mengubah data gambar organisasi',
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrganizationImage  $organizationImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrganizationImage $organizationImage)
    {
        // delete old photo
        $oldImage = $visionImage->image;
        $oldImagePath = public_path('organization').'/'.$oldImage;
        if (file_exists($oldImagePath)) {
            File::delete($oldImagePath);
        }

        $organizationImage->delete();
        return response()->json([
            'message' => 'Berhasil menghapus gambar organisasi',
            'success' => true
        ]);
    }
}
