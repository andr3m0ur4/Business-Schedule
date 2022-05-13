<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeTimeRequest;
use App\Http\Requests\UpdateEmployeeTimeRequest;
use App\Http\Resources\EmployeeTimeResource;
use App\Models\EmployeeTime;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        $employeeTime = EmployeeTime::create($request->all());
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
        //
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
        $employeeTime->update($request->all());
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
        //
    }

    public function save(Request $request)
    {
        $insertRows = 0;
        $affectedRows = 0;
        // return response()->json($request->all());

        foreach ($request->all() as $item) {
            $time = [];
            $time['id'] = $item['id'];
            $time['start'] = $item['startDateTime'];
            $time['end'] = $item['endDateTime'];
            $time['user_id'] = $item['raw']['employeeId'];

            $employeeTime = EmployeeTime::where('id', $item['id'])->first();
            if ($employeeTime) {
                $myRequest = new UpdateEmployeeTimeRequest();
                $myRequest->setMethod('PUT');
                $myRequest->request->add($time);
                $this->update($myRequest, $employeeTime);
                $affectedRows++;
                continue;
            }

            $myRequest = new StoreEmployeeTimeRequest();
            $myRequest->setMethod('POST');
            $myRequest->request->add($time);
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
