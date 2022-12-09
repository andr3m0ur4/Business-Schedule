<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
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
     * @param  \App\Http\Requests\StoreScheduleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreScheduleRequest $request)
    {
        $schedule = Schedule::create($request->validated());
        return response()->json($schedule, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateScheduleRequest  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateScheduleRequest $request, Schedule $schedule)
    {
        $schedule->update($request->validated());
        return response()->json($schedule, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return response()->json($schedule);
    }

    public function destroyWhereTvShowTimeIsNotIn(string $employeTimeId, array $tvShowTimeIds)
    {
        $schedules = Schedule::where('employee_time_id', $employeTimeId)
                        ->whereNotIn('tv_show_time_id', $tvShowTimeIds)
                        ->get();

        if ($schedules->isNotEmpty()) {
            foreach ($schedules as $schedule) {
                $schedule->delete();
            }
        }
    }

    public function save(Request $request)
    {
        $insert = 0;
        $employeTimeId = 0;
        $arrayTvShowTimeId = [];

        foreach ($request->all() as $attributes) {
            $employeTimeId = $attributes['employee_time_id'];
            $arrayTvShowTimeId[] = $attributes['tv_show_time_id'];

            $schedule = Schedule::find($attributes['id']);
            if ($schedule) {
                $schedule->fill($attributes);
            } else {
                $schedule = new Schedule($attributes);
                $insert++;
            }

            $schedule->save();
        }

        if (!empty($arrayTvShowTimeId)) {
            $this->destroyWhereTvShowTimeIsNotIn($employeTimeId, $arrayTvShowTimeId);
        }

        return response()->json(['success' => $insert]);
    }

    public function manage($item, $time)
    {
        if (isset($item['raw']['schedules']) && count($item['raw']['schedules']) > 0) {
            $schedules = Schedule::where('employee_time_id', $time['id'])->get();
            if ($schedules) {
                foreach ($schedules as $schedule) {
                    $this->destroy($schedule);
                }
            }

            foreach ($item['raw']['schedules'] as $schedule) {
                $scheduleTime['tv_show_time_id'] = $schedule['tv_show_time']['id'];
                $scheduleTime['employee_time_id'] = $time['id'];
                $scheduleTime['worked_times'] = 100000;

                $myRequest = new StoreScheduleRequest();
                $myRequest->setMethod('POST');
                $myRequest->setValidator(Validator::make($scheduleTime, $myRequest->rules()));
                $this->store($myRequest);
            }
        }
    }
    public function countSchedule(){

        $count = DB::getPdo()->prepare("SELECT COUNT(id) as total FROM schedules");
        $count->execute();
        return response()->json($count->fetchObject());

    }

    public function countTimeSchedule(){

        $count = DB::getPdo()->prepare("SELECT CASE (DATEDIFF( (created_at  + INTERVAL '7' DAY),CURRENT_TIMESTAMP) + 1)
            WHEN 8 THEN 7
            ELSE (DATEDIFF( (created_at  + INTERVAL '7' DAY),CURRENT_TIMESTAMP) + 1)
            END as time FROM schedules WHERE created_at = (SELECT MAX(created_at) FROM schedules)");
        $count->execute();
        return response()->json($count->fetchObject());

    }
    
}


