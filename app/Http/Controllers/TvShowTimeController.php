<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTvShowTimeRequest;
use App\Http\Requests\UpdateTvShowTimeRequest;
use App\Models\TvShowTime;
use Illuminate\Http\Response;

class TvShowTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tvShowTimes = TvShowTime::all();
        return response()->json($tvShowTimes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTvShowTimeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTvShowTimeRequest $request)
    {
        $tvShowTime = TvShowTime::create($request->validated());
        return response()->json($tvShowTime, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TvShowTime  $tvShowTime
     * @return \Illuminate\Http\Response
     */
    public function show(TvShowTime $tvShowTime)
    {
        return response()->json($tvShowTime);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTvShowTimeRequest  $request
     * @param  \App\Models\TvShowTime  $tvShowTime
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTvShowTimeRequest $request, TvShowTime $tvShowTime)
    {
        $tvShowTime->update($request->validated());
        return response()->json($tvShowTime);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TvShowTime  $tvShowTime
     * @return \Illuminate\Http\Response
     */
    public function destroy(TvShowTime $tvShowTime)
    {
        $tvShowTime->delete();
        return response()->json($tvShowTime);
    }
}
