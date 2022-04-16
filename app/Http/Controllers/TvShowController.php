<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTvShowRequest;
use App\Http\Requests\UpdateTvShowRequest;
use App\Models\TvShow;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class TvShowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(TvShow::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTvShowRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTvShowRequest $request)
    {
        //if ($request->hasFile('file')) {
        //    $file = $request->file('file');
        //    $fileUrn = $file->store('files', 'public');
        //}

        //$tvShow = TvShow::create([
        //    'name' => $request->name,
        //   'description' => $request->description,
        //    'file' => $fileUrn ?? null
        //]);

        $tvShow = TvShow::create($request->validated());
        return response()->json($tvShow, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TvShow  $tvShow
     * @return \Illuminate\Http\Response
     */
    public function show(TvShow $tvShow)
    {
        return response()->json($tvShow);
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
        $fileUrn = $tvShow->file;
        $tvShow->fill($request->validated());

        //if ($request->hasFile('file')) {
        //    $file = $request->file('file');
        //    $fileUrn = $file->store('files', 'public');
        //    Storage::disk('public')->delete($tvShow->file);
        // }

        //$tvShow->file = $fileUrn;
        $tvShow->save();

        return response()->json($tvShow);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TvShow  $tvShow
     * @return \Illuminate\Http\Response
     */
    public function destroy(TvShow $tvShow)
    {
        //Storage::disk('public')->delete($tvShow->file);

        $tvShow->delete();
        return response()->json($tvShow);
    }
}
