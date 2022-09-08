<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSwitcherRequest;
use App\Http\Requests\UpdateSwitcherRequest;
use App\Models\Switcher;
use Illuminate\Http\Response;

class SwitcherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Switcher::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSwitcherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSwitcherRequest $request)
    {
        $switcher = Switcher::create($request->validated());
        return response()->json($switcher, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Switcher  $switcher
     * @return \Illuminate\Http\Response
     */
    public function show(Switcher $switcher)
    {
        return response()->json($switcher);
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
        $switcher->update($request->validated());
        return response()->json($switcher);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Switcher  $switcher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Switcher $switcher)
    {
        $switcher->delete();
        return response()->json($switcher);
    }
}
