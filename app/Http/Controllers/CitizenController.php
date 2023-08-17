<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\CitizenImport;
use App\Exports\CitizenExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Citizen;
use App\Models\Institution;
use App\Models\InstitutionStructure;

class CitizenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $citizens = Citizen::get();
        return response()->json([
            'success' => true,
            'message' => 'Success getting citizens',
            'data' => $citizens
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Citizen  $citizen
     * @return \Illuminate\Http\Response
     */
    public function show(Citizen $citizen)
    {
        return response()->json([
            'success' => true,
            'message' => 'Success getting citizen',
            'data' => $citizen
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Citizen  $citizen
     * @return \Illuminate\Http\Response
     */
    public function edit(Citizen $citizen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Citizen  $citizen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Citizen $citizen)
    {
        $citizen->update($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Success updating citizen',
            'data' => $citizen
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Citizen  $citizen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Citizen $citizen)
    {
        $citizen->delete();
        return response()->json([
            'success' => true,
            'message' => 'Success deleting citizen',
            'data' => $citizen
        ]);
    }

    public function import(Request $request)
    {
        $file = $request->file('file');

        Excel::import(new CitizenImport,  $file);

        $citizens = Citizen::get();
        $citizen_rt = $citizens->pluck('rt')->unique();
        foreach ($citizen_rt as $rt) {
            $institution = Institution::create([
                'name' => "RT $rt",
            ]);
            $administrators = Citizen::where('rt', "$rt")->where('position', '<>', 'Warga')->get();
            foreach ($administrators as $admin) {
                InstitutionStructure::create([
                    'institution_id' => $institution->id,
                    'name' => $admin->name,
                    'position' => $admin->position,
                ]);
            }
        }

        return response()->json([
            'message' => 'success',
        ]);
    }

    public function export(Request $request) {
        return Excel::download(new CitizenExport, 'Data Warga.xlsx');
    }

    public function countCitizen() {
        $citizen_total = Citizen::count();
        $rt_total = Citizen::pluck('rt')->unique()->count();
        $female_total = Citizen::where('gender', 'P')->orWhere('gender', 'p')->count();
        $male_total = Citizen::where('gender', 'L')->orWhere('gender', 'l')->count();
        $kk_total = Citizen::where('is_head_of_family', 1)->count();

        return response()->json([
            'success' => true,
            'message' => 'Success getting citizen statistic',
            'data' => [
                'citizen_total' => $citizen_total,
                'rt_total' => $rt_total,
                'female_total' => $female_total,
                'male_total' => $male_total,
                'kk_total' => $kk_total,
            ]
        ], 200);
    }
}
