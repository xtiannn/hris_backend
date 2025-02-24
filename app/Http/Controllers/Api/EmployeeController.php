<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::isActive()->with(['user', 'salary', 'department'])->get();
        // $employees = Employee::isActive()->get();

        if($employees->count() > 0){
            return response()->json($employees);
        }else{
            return response()->json(['message' => 'No employees found'], 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_id_number' => 'required|string',
            'birthdate' => 'nullable|date',
            'reports_to' => 'nullable|string',
            'gender' => 'nullable|string',
            'user_id' => 'required|numeric',
            'department_id' => 'required|numeric',
            'designation_id' => 'required|numeric',
        ]);

        Employee::create($request->all());

        return response()->json(['message' => 'New employee has been added successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return response()->json(['employee', $employee]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'company_id_number' => 'required|string',
            'birthdate' => 'nullable|date',
            'reports_to' => 'nullable|string',
            'gender' => 'nullable|string',
            'user_id' => 'required|numeric',
            'department_id' => 'required|numeric',
            'designation_id' => 'required|numeric',
        ]);

        $employee->update($request->all());
        return response()->json(['message' => 'Employee updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->isActive = 0;
        $employee->save();
        return response()->json(['message', 'Employee has been successfully deleted!']);
    }
}
