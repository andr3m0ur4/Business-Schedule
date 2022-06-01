<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTvShowTimeRequest;
use App\Http\Requests\UpdateTvShowTimeRequest;
use App\Http\Resources\TvShowTimeResource;
use App\Models\TvShowTime;
use App\Repositories\TvShowTimeRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class TvShowTimeController extends Controller
{
    private $repository;

    public function __construct(TvShowTimeRepository $tvShowTimeRepository)
    {
        $this->repository = $tvShowTimeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tvShowTimes = TvShowTime::all();
        return response()->json(TvShowTimeResource::collection($tvShowTimes));
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
        return response()->json(new TvShowTimeResource($tvShowTime));
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

    public function filters(Request $request)
    {
        $tvShowTimes = $this->repository->selectAttributesRelational($request)
            ->filter($request)
            ->selectAttributes($request)
            ->getResults();
        return response()->json($tvShowTimes);
    }

    public function save(Request $request)
    {
        $insertRows = 0;
        $affectedRows = 0;

        foreach ($request->all() as $item) {
            $time = [];
            $time['id'] = $item['id'];
            $time['start'] = $item['startDateTime'];
            $time['end'] = $item['endDateTime'];
            $time['mode'] = 'Ao Vivo';
            $time['tv_show_id'] = $item['raw']['tvShow']['id'];
            $time['studio_id'] = $item['raw']['studio']['id'];
            $time['switcher_id'] = $item['raw']['switcher']['id'];

            $tvShowTime = TvShowTime::where('id', $item['id'])->first();
            if ($tvShowTime) {
                $myRequest = new UpdateTvShowTimeRequest();
                $myRequest->setMethod('PUT');
                $myRequest->setValidator(Validator::make($time, $myRequest->rules()));
                $this->update($myRequest, $tvShowTime);
                $affectedRows++;
                continue;
            }

            $myRequest = new StoreTvShowTimeRequest();
            $myRequest->setMethod('POST');
            $myRequest->setValidator(Validator::make($time, $myRequest->rules()));
            $this->store($myRequest);
            $insertRows++;
        }

        return response()->json([
            'success' => 1,
            'insert_rows' => $insertRows,
            'affected_rows' => $affectedRows
        ], Response::HTTP_OK);
    }
}
