<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTvShowRequest;
use App\Http\Requests\UpdateTvShowRequest;
use App\Models\TvShow;

class TvShowController extends Controller
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
     * @param  \App\Http\Requests\StoreTvShowRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTvShowRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TvShow  $tvShow
     * @return \Illuminate\Http\Response
     */
    public function show(TvShow $tvShow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TvShow  $tvShow
     * @return \Illuminate\Http\Response
     */
    public function edit(TvShow $tvShow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTvShowRequest  $request
     * @param  \App\Models\TvShow  $tvShow
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTvShowRequest $request, TvShow $tvShow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TvShow  $tvShow
     * @return \Illuminate\Http\Response
     */
    public function destroy(TvShow $tvShow)
    {
        //
    }
}
