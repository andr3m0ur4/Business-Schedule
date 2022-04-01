<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeTimeRequest;
use App\Http\Requests\UpdateEmployeeTimeRequest;
use App\Models\EmployeeTime;

class EmployeeTimeController extends Controller
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
     * @param  \App\Http\Requests\StoreEmployeeTimeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeTimeRequest $request)
    {
        //
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
        //
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
}
