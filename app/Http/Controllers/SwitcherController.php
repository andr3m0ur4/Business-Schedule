<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSwitcherRequest;
use App\Http\Requests\UpdateSwitcherRequest;
use App\Models\Switcher;

class SwitcherController extends Controller
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
     * @param  \App\Http\Requests\StoreSwitcherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSwitcherRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Switcher  $switcher
     * @return \Illuminate\Http\Response
     */
    public function show(Switcher $switcher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Switcher  $switcher
     * @return \Illuminate\Http\Response
     */
    public function edit(Switcher $switcher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSwitcherRequest  $request
     * @param  \App\Models\Switcher  $switcher
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSwitcherRequest $request, Switcher $switcher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Switcher  $switcher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Switcher $switcher)
    {
        //
    }
}
