<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeTimeRequest;
use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateEmployeeTimeRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Http\Resources\EmployeeTimeResource;
use App\Models\EmployeeTime;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class EmployeeTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employeeTimes = EmployeeTime::all();
        return response()->json(EmployeeTimeResource::collection($employeeTimes));
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
     * @param  \App\Http\Requests\StoreEmployeeTimeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeTimeRequest $request)
    {
        $employeeTime = EmployeeTime::create($request->validated());
        return response()->json($employeeTime, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmployeeTime  $employeeTime
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeTime $employeeTime)
    {
        return response()->json(EmployeeTimeResource::make($employeeTime), Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeeTime  $employeeTime
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeTime $employeeTime)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployeeTimeRequest  $request
     * @param  \App\Models\EmployeeTime  $employeeTime
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeTimeRequest $request, EmployeeTime $employeeTime)
    {
        $employeeTime->update($request->validated());
        return response()->json($employeeTime, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeeTime  $employeeTime
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeTime $employeeTime)
    {
        $employeeTime->delete();
        return response()->json($employeeTime);
    }

    public function save(Request $request)
    {
        $insertRows = 0;
        $affectedRows = 0;
        $deletedRows = 0;

        foreach ($request->all() as $item) {
            $time = [];
            $time['id'] = $item['id'];

            if (!$item['isVisible']) {
                $employeeTime = EmployeeTime::where('id', $item['id'])->first();
                if ($employeeTime) {
                    $this->destroy($employeeTime);
                    $deletedRows++;
                }
                continue;
            }

            $time['start'] = $item['startDateTime'];
            $time['end'] = $item['endDateTime'];
            $time['user_id'] = $item['raw']['employee']['id'];

            $employeeTime = EmployeeTime::where('id', $item['id'])->first();
            if ($employeeTime) {
                $myRequest = new UpdateEmployeeTimeRequest();
                $myRequest->setMethod('PUT');
                $myRequest->setValidator(Validator::make($time, $myRequest->rules()));
                $this->update($myRequest, $employeeTime);
                $affectedRows++;

                if (isset($item['raw']['schedules']) && count($item['raw']['schedules']) > 0) {
                    $schedules = Schedule::where('employee_time_id', $time['id'])->get();
                    $scheduleController = new ScheduleController();
                    if ($schedules) {
                        foreach ($schedules as $schedule) {
                            $scheduleController->destroy($schedule);
                        }
                    }

                    foreach ($item['raw']['schedules'] as $schedule) {
                        $scheduleTime['tv_show_time_id'] = $schedule['tv_show_time']['id'];
                        $scheduleTime['employee_time_id'] = $time['id'];
                        $scheduleTime['worked_times'] = 100000;

                        $myRequest = new StoreScheduleRequest();
                        $myRequest->setMethod('POST');
                        $myRequest->setValidator(Validator::make($scheduleTime, $myRequest->rules()));
                        $scheduleController->store($myRequest);
                    }
                }
                continue;
            }

            $myRequest = new StoreEmployeeTimeRequest();
            $myRequest->setMethod('POST');
            $myRequest->setValidator(Validator::make($time, $myRequest->rules()));
            $this->store($myRequest);
            $insertRows++;

            if (isset($item['raw']['schedules']) && count($item['raw']['schedules']) > 0) {
                $schedules = Schedule::where('employee_time_id', $time['id']);
                $scheduleController = new ScheduleController();
                if ($schedules) {
                    foreach ($schedules as $schedule) {
                        $scheduleController->destroy($schedule);
                    }
                }

                foreach ($item['raw']['schedules'] as $schedule) {
                    $scheduleTime['tv_show_time_id'] = $schedule['tv_show_time']['id'];
                    $scheduleTime['employee_time_id'] = $time['id'];
                    $scheduleTime['worked_times'] = 100000;

                    $myRequest = new StoreScheduleRequest();
                    $myRequest->setMethod('POST');
                    $myRequest->setValidator(Validator::make($scheduleTime, $myRequest->rules()));
                    $scheduleController->store($myRequest);
                }
            }
        }

        return response()->json([
            'success' => 1,
            'insert_rows' => $insertRows,
            'affected_rows' => $affectedRows,
            'deleted_rows' => $deletedRows
        ], Response::HTTP_OK);
    }
}
