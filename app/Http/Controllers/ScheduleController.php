<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Models\Schedule;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

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
}
