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
use Illuminate\Support\Facades\DB;
use PDO;

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
        // $employeeTimes = EmployeeTime::offset(0)->limit(10)->get();
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
        $employeeTime->id = $request->id;
        return response()->json(EmployeeTimeResource::make($employeeTime), Response::HTTP_CREATED);
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
        return response()->json(EmployeeTimeResource::make($employeeTime), Response::HTTP_OK);
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

    public function save(UpdateEmployeeTimeRequest $request)
    {
        $employeeTime = EmployeeTime::find($request->id);
        if ($employeeTime) {
            $employeeTime->fill($request->all());
            $employeeTime->save();
            return response()->json(EmployeeTimeResource::make($employeeTime), Response::HTTP_OK);
            // $scheduleController->manage($item, $time);
        }

        $employeeTime = new EmployeeTime($request->all());
        $employeeTime->save();
        $employeeTime->id = $request->id;
        return response()->json(EmployeeTimeResource::make($employeeTime), Response::HTTP_CREATED);
    }

    public function saveAll(Request $request)
    {
        $insertRows = 0;
        $affectedRows = 0;
        $deletedRows = 0;

        foreach ($request->all() as $item) {
            $time = [];
            $time['id'] = $item['id'];

            $employeeTime = EmployeeTime::where('id', $item['id'])->first();
            if (!$item['isVisible']) {
                if ($employeeTime) {
                    $this->destroy($employeeTime);
                    $deletedRows++;
                }
                continue;
            }

            $time['start'] = $item['startDateTime'];
            $time['end'] = $item['endDateTime'];
            $time['user_id'] = $item['raw']['employee']['id'];
            $scheduleController = new ScheduleController();

            if ($employeeTime) {
                $myRequest = new UpdateEmployeeTimeRequest();
                $myRequest->setMethod('PUT');
                $myRequest->setValidator(Validator::make($time, $myRequest->rules()));
                $this->update($myRequest, $employeeTime);
                $affectedRows++;

                $scheduleController->manage($item, $time);
                continue;
            }

            $myRequest = new StoreEmployeeTimeRequest();
            $myRequest->setMethod('POST');
            $myRequest->setValidator(Validator::make($time, $myRequest->rules()));
            $this->store($myRequest);
            $insertRows++;

            $scheduleController->manage($item, $time);
        }

        return response()->json([
            'success' => 1,
            'insert_rows' => $insertRows,
            'affected_rows' => $affectedRows,
            'deleted_rows' => $deletedRows
        ], Response::HTTP_OK);
    }

    public function countEmployeeTime(){

        $data = DB::getPdo()->prepare("SELECT TIME_FORMAT(sum((TIMEDIFF(emp_time.end,emp_time.start)- INTERVAL 6 hour)), '%H:%i:%s') hour_emp,us.name FROM employee_times as emp_time 
            INNER JOIN users as us ON us.id = emp_time.user_id
            WHERE MONTH(emp_time.START) = MONTH(CURRENT_TIMESTAMP) and (HOUR(emp_time.end) - HOUR(emp_time.start)) > 6
            GROUP BY emp_time.user_id ORDER BY hour_emp DESC LIMIT 10");
        $data->execute();
        return response()->json($data->fetchAll(PDO::FETCH_ASSOC));

    }

    public function countSundayTime(){

        $data = DB::getPdo()->prepare("SELECT count(emp_time.id) quant, us.name FROM employee_times as emp_time 
        INNER JOIN users as us ON us.id = emp_time.user_id
        WHERE dayname(emp_time.START) = 'Sunday' and MONTH(emp_time.START) = '11'
        GROUP BY us.name ORDER BY quant DESC LIMIT 10");
        $data->execute();
        return response()->json($data->fetchAll(PDO::FETCH_ASSOC));

    }
  
}
