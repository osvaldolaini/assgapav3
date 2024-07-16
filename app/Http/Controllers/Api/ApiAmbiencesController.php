<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin\Ambiences\Ambience;
use Illuminate\Http\Request;

class ApiAmbiencesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ambiences = Ambience::select('id', 'title', 'capacity', 'time_week', 'time_weekend', 'need', 'ambience_category')
            ->where('active', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        $apiAmbience = array();
        foreach ($ambiences as $ambience) {
            $apiAmbience[] = array(
                'title'         => $ambience->title,
                'id'            => $ambience->id,
                'category'      => $ambience->category->title,
                'capacity'      => $ambience->capacity,
                'time_week'     => $ambience->time_week,
                'time_weekend'  => $ambience->time_weekend,
                'need'          => $ambience->need,
            );
        }
        if (isset($apiAmbience)) {
            return response()->json(
                [
                    'success' => true,
                    'data'   => $apiAmbience,
                ]
            );
        } else {
            return response()->json(
                [
                    'success' => false,
                    'error' => false,
                ]
            );
        }
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
     * @param  \App\Model\Admin\ambience  $ambience
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        if (Ambience::where('id', $id)->exists()) {
            $ambience = Ambience::select('id', 'title', 'capacity', 'time_week', 'time_weekend', 'need', 'ambience_category')
                ->where('id', $id)
                ->first();

            $apiAmbience = array(
                'title'         => $ambience->title,
                'id'            => $ambience->id,
                'category'      => $ambience->category->title,
                'capacity'      => $ambience->capacity,
                'time_week'     => $ambience->time_week,
                'time_weekend'  => $ambience->time_weekend,
                'need'          => $ambience->need,
            );

            return response($apiAmbience, 200);
        } else {
            return response()->json([
                "message" => 'Ambiente não encontrado'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Admin\ambience  $ambience
     * @return \Illuminate\Http\Response
     */
    public function edit(ambience $ambience)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Admin\ambience  $ambience
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ambience $ambience)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Admin\ambience  $ambience
     * @return \Illuminate\Http\Response
     */
    public function destroy(ambience $ambience)
    {
        //
    }
}
