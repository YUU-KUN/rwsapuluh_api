<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $video = Video::first();
        return response()->json([
            'success' => true,
            'message' => 'Success getting video',
            'data' => $video
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
        Video::truncate();
        $input = $request->all();
        $filename = time().'.'.$request->video->getClientOriginalExtension();
        $request->video->move(public_path('video'), $filename);
        $input['video'] = $filename;
        $video = Video::create($input);
        return response()->json([
            'success' => true,
            'message' => 'Success creating video',
            'data' => $video
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        return response()->json([
            'success' => true,
            'message' => 'Success getting video',
            'data' => $video
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        $input = $request->all();
        if ($request->hasFile('video')) {
            $filename = time().'.'.$request->video->getClientOriginalExtension();
            $request->video->move(public_path('video'), $filename);
            $input['video'] = $filename;
        } else {
            $input['video'] = $video->video;
        }

        // delete old video
        $oldVideo = public_path('video').'/'.$video->video;
        if (file_exists($oldVideo)) {
            unlink($oldVideo);
        }

        $video->update($input);
        return response()->json([
            'success' => true,
            'message' => 'Success updating video',
            'data' => $video
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        $video->delete();
        return response()->json([
            'success' => true,
            'message' => 'Success deleting video',
            'data' => $video
        ]);
    }
}
