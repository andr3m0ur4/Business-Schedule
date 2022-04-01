<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTvShowTimeRequest;
use App\Http\Requests\UpdateTvShowTimeRequest;
use App\Models\TvShowTime;

class TvShowTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreTvShowTimeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTvShowTimeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TvShowTime  $tvShowTime
     * @return \Illuminate\Http\Response
     */
    public function show(TvShowTime $tvShowTime)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TvShowTime  $tvShowTime
     * @return \Illuminate\Http\Response
     */
    public function edit(TvShowTime $tvShowTime)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TvShowTime  $tvShowTime
     * @return \Illuminate\Http\Response
     */
    public function destroy(TvShowTime $tvShowTime)
    {
        //
    }
}
