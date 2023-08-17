<?php

namespace App\Http\Controllers;

use App\Models\VisionImage;
use Illuminate\Http\Request;
use File;

class VisionImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'data' => VisionImage::all(),
            'message' => 'Berhasil mendapatkan data gambar visi',
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
        $request->image->move(public_path('vision'), $filename);
        $input['image'] = $filename;

        $visionImage = VisionImage::create($input);
        return response()->json([
            'data' => $visionImage,
            'message' => 'Berhasil menambahkan gambar visi',
            'success' => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VisionImage  $visionImage
     * @return \Illuminate\Http\Response
     */
    public function show(VisionImage $visionImage)
    {
        return response()->json([
            'data' => $visionImage,
            'message' => 'Berhasil mendapatkan data gambar visi',
            'success' => true
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VisionImage  $visionImage
     * @return \Illuminate\Http\Response
     */
    public function edit(VisionImage $visionImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VisionImage  $visionImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VisionImage $visionImage)
    {
        $input = $request->all();

        if ($request->hasFile('image')) {
            $filename = time().'.'.$request->image->extension();
            $request->image->move(public_path('vision'), $filename);
            $input['image'] = $filename;
    
            // remove old image
            $oldImage = $visionImage->image;
            $oldImagePath = public_path('vision').'/'.$oldImage;
            if (file_exists($oldImagePath)) {
                File::delete($oldImagePath);
            }
        } else {
            $input['image'] = $visionImage->image;
        }

        $visionImage->update($input);
        
        return response()->json([
            'data' => $visionImage,
            'message' => 'Berhasil mengubah data gambar visi',
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VisionImage  $visionImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(VisionImage $visionImage)
    {
        // delete old photo
        $oldImage = $visionImage->image;
        $oldImagePath = public_path('vision').'/'.$oldImage;
        if (file_exists($oldImagePath)) {
            File::delete($oldImagePath);
        }

        $visionImage->delete();
        return response()->json([
            'message' => 'Berhasil menghapus gambar organisasi',
            'success' => true
        ]);
    }
}
