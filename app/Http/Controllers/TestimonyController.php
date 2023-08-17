<?php

namespace App\Http\Controllers;

use App\Models\Testimony;
use Illuminate\Http\Request;

class TestimonyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimony = Testimony::orderBy('created_at', 'desc')->get();
        return response()->json([
            'success' => true,
            'message' => 'List Data testimonies',
            'data'    => $testimony
        ], 200);
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
        $testimony = Testimony::create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Data testimony berhasil di tambahkan',
            'data'    => $testimony
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Testimony  $testimony
     * @return \Illuminate\Http\Response
     */
    public function show(Testimony $testimony)
    {
        return response()->json([
            'success' => true,
            'message' => 'Detail Data testimony',
            'data'    => $testimony
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Testimony  $testimony
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimony $testimony)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Testimony  $testimony
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testimony $testimony)
    {
        $testimony->update($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Data testimony berhasil di update',
            'data'    => $testimony
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Testimony  $testimony
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimony $testimony)
    {
        $testimony->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data testimony berhasil di hapus',
        ], 200);
    }
}
