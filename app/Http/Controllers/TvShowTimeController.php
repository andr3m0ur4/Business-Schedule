<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTvShowTimeRequest;
use App\Http\Requests\UpdateTvShowTimeRequest;
use App\Http\Resources\TvShowTimeResource;
use App\Models\TvShowTime;
use App\Repositories\TvShowTimeRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PDO;

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
        $tvShowTime->id = $request->id;
        return response()->json(TvShowTimeResource::make($tvShowTime), Response::HTTP_CREATED);
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

    public function save(UpdateTvShowTimeRequest $request)
    {
        $tvShowTime = TvShowTime::find($request->id);
        if ($tvShowTime) {
            $tvShowTime->fill($request->all());
            $tvShowTime->save();
            return response()->json(TvShowTimeResource::make($tvShowTime), Response::HTTP_OK);
        }

        $tvShowTime = new TvShowTime($request->all());
        $tvShowTime->save();
        $tvShowTime->id = $request->id;
        return response()->json(TvShowTimeResource::make($tvShowTime), Response::HTTP_CREATED);
    }

    public function saveAll(Request $request)
    {
        $insertRows = 0;
        $affectedRows = 0;
        $deletedRows = 0;

        foreach ($request->all() as $item) {
            $time = [];
            $time['id'] = $item['id'];

            if (!$item['isVisible']) {
                $tvShowTime = TvShowTime::where('id', $item['id'])->first();
                if ($tvShowTime) {
                    $this->destroy($tvShowTime);
                    $deletedRows++;
                }
                continue;
            }

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
            'affected_rows' => $affectedRows,
            'deleted_rows' => $deletedRows
        ], Response::HTTP_OK);
    }

    public function countTvShowEmployees(){

        $data = DB::getPdo()->prepare("SELECT tv.name, COUNT(DISTINCT emp_time.user_id) count_user FROM tv_show_times as tv_time
        INNER JOIN tv_shows tv ON tv_time.tv_show_id = tv.id
        INNER JOIN schedules as sche on tv_time.id = sche.tv_show_time_id
        INNER JOIN employee_times emp_time ON sche.employee_time_id = emp_time.id
        WHERE DATE_FORMAT(tv_time.start,'%d/%m/%Y') BETWEEN DATE_FORMAT(CURRENT_TIMESTAMP,'%d/%m/%Y') AND DATE_FORMAT((CURRENT_TIMESTAMP + INTERVAL '7' DAY),'%d/%m/%Y')
        GROUP BY tv.name ORDER BY count_user DESC LIMIT 10");
        $data->execute();
        return response()->json($data->fetchAll(PDO::FETCH_ASSOC));

    }
}
