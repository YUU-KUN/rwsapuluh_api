<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityImage;
use App\Models\ActivityCategory;
use Illuminate\Http\Request;
use File;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activity = Activity::with('Categories.Category:id,name')->get();

        return response()->json([
            'data' => $activity,
            'message' => 'Berhasil mendapatkan data kegiatan',
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
        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('activity'), $filename);
            $input['image'] = $filename;
        }

        $activity = Activity::create($input);
        if ($activity) {
            if (isset($input['category_ids']) && is_array($input['category_ids'])) {
                foreach ($input['category_ids'] as $category_id) {
                    ActivityCategory::create([
                        'activity_id' => $activity->id,
                        'category_id' => $category_id
                    ]);
                }
            }
        }

        return response()->json([
            'message' => 'Berhasil menyimpan kegiatan baru',
            'success' => true,
            'data' => $activity
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity, $id)
    {
        $activity = Activity::find($id);
        return response()->json([
            'data' => $activity,
            'message' => 'Berhasil mendapatkan detail kegiatan',
            'success' => true
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        $input = $request->all();
        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('activity'), $filename);
            $input['image'] = $filename;

            // remove old image
            $oldImage = $activity->image;
            $oldImagePath = public_path('activity').'/'.$oldImage;
            if (file_exists($oldImagePath)) {
                File::delete($oldImagePath);
            }
        } else {
            $input['image'] = $activity->image;
        }

        if (isset($input['category_ids']) && is_array($input['category_ids'])) {
            // delete old activity category
            ActivityCategory::where('activity_id', $activity->id)->delete();
            foreach ($input['category_ids'] as $category_id) {
                ActivityCategory::create([
                    'activity_id' => $activity->id,
                    'category_id' => $category_id
                ]);
            }
        }

        $activity->update($input);

        return response()->json([
            'data' => $activity,
            'message' => 'Berhasil mengupdate data user',
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        $activity->delete();

        return response()->json([
            'message' => 'Berhasil menghapus data kegiatan',
            'success' => true
        ]);
    }

    public function getTopActivity() {
        $activity = Activity::with('Categories.Category:id,name')->orderBy('created_at', 'desc')->limit(3)->get();

        return response()->json([
            'data' => $activity,
            'message' => 'Berhasil mendapatkan data kegiatan',
            'success' => true
        ]);
    }
}
