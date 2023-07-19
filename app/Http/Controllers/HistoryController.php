<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;
use File;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $history = History::first();
        return response()->json([
            'success' => true,
            'message' => 'Success getting history',
            'data' => $history
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
            $filename = time().'.'.$request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('history'), $filename);
            $input['photo'] = $filename;
        }

        $history = History::create($input);
        return response()->json([
            'success' => true,
            'message' => 'Success creating history',
            'data' => $history
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function show(History $history)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function edit(History $history)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, History $history)
    {
        $input = $request->all();
        if ($request->hasFile('photo')) {   
            $filename = time().'.'.$request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('history'), $filename);
            $input['photo'] = $filename;

            // remove old photo
            if (isset($history->photo)) {
                $old_photo = $history->photo;
                $filepath = public_path('history') . '/' . $history->photo;
                try {
                    File::delete($filepath);
                } catch (FileNotFoundException $e) {
                    // File sudah dihapus/tidak ada
                }
            }
        }
        $history->update($input);
        return response()->json([
            'success' => true,
            'message' => 'Success updating history',
            'data' => $history
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function destroy(History $history)
    {
        //
    }
}
