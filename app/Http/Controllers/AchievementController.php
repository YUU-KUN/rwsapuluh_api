<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\AchievementCategory;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $achievement = Achievement::with('Categories.Category:id,name')->get();
        return response()->json([
            'success' => true,
            'message' => 'Success getting achievement',
            'data' => $achievement
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
        $request->image->move(public_path('achievement'), $filename);
        $input['image'] = $filename;

        $achievement = Achievement::create($input);

        if ($achievement) {
            if (isset($input['category_ids']) && is_array($input['category_ids'])) {
                foreach ($input['category_ids'] as $category_id) {
                    AchievementCategory::create([
                        'achievement_id' => $achievement->id,
                        'category_id' => $category_id
                    ]);
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Success creating achievement',
            'data' => $request->all()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Achievement  $achievement
     * @return \Illuminate\Http\Response
     */
    public function show(Achievement $achievement)
    {
        return response()->json([
            'success' => true,
            'message' => 'Success retrieving achievement',
            'data' => $achievement
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Achievement  $achievement
     * @return \Illuminate\Http\Response
     */
    public function edit(Achievement $achievement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Achievement  $achievement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Achievement $achievement)
    {
        $input = $request->all();
        if ($request->hasFile('image')) {
            $filename = time().'.'.$request->image->extension();
            $request->image->move(public_path('achievement'), $filename);
            $input['image'] = $filename;
    
            // remove old image
            $oldImage = $achievement->image;
            $oldImagePath = public_path('achievement').'/'.$oldImage;
            if (file_exists($oldImagePath)) {
                File::delete($oldImagePath);
            }
        } else {
            $input['image'] = $achievement->image;
        }

        if (isset($input['category_ids']) && is_array($input['category_ids'])) {
            // delete old achievement category
            AchievementCategory::where('achievement_id', $achievement->id)->delete();
            foreach ($input['category_ids'] as $category_id) {
                AchievementCategory::create([
                    'achievement_id' => $achievement->id,
                    'category_id' => $category_id
                ]);
            }
        }

        $achievement->update($input);
        
        return response()->json([
            'success' => true,
            'message' => 'Success updating achievement',
            'data' => $achievement
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Achievement  $achievement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Achievement $achievement)
    {
        $achievement->delete();
        return response()->json([
            'success' => true,
            'message' => 'Success deleting achievement',
            'data' => $achievement
        ]);
    }

    public function getTopAchievement() {
        $achievement = Achievement::orderBy('created_at', 'desc')->take(3)->with('Category')->get();
        return response()->json([
            'success' => true,
            'message' => 'Success getting top achievement',
            'data' => $achievement
        ]);
    }
}
