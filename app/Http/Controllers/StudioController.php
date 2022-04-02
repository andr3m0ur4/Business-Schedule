<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudioRequest;
use App\Http\Requests\UpdateStudioRequest;
use App\Models\Studio;

class StudioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Studio::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudioRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudioRequest $request)
    {
        $studio = Studio::create($request->validated());
        return response()->json($studio, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Studio  $studio
     * @return \Illuminate\Http\Response
     */
    public function show(Studio $studio)
    {
        return response()->json($studio);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudioRequest  $request
     * @param  \App\Models\Studio  $studio
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudioRequest $request, Studio $studio)
    {
        $studio->update($request->all());
        return response()->json($studio);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Studio  $studio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Studio $studio)
    {
        $studio->delete();
        return response()->json($studio);
    }
}
