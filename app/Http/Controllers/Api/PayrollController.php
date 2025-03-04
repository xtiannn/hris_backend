<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payroll;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = Payroll::with('employee')->get(); // Eager load employee details

        return response()->json($result, 200);
    }

    /**
     * Store a newly created payroll record.
     */
    public function store(Request $request)
    {
        try {
            $params = $request->validate([
                'employee_id' => 'required|integer|exists:employees,id',
                'salary_id' => 'required|integer|exists:salaries,id',
                'total_earnings' => 'required|numeric|min:0',
                'total_deductions' => 'required|numeric|min:0',
                'net_salary' => 'required|numeric|min:0',
                'pay_date' => 'required|date',
                'status' => 'required|string|in:pending,processed,paid'
            ]);


            // Calculate net salary
            $params['net_salary'] = $params['total_earnings'] - $params['total_deductions'];

            $payroll = Payroll::create($params);

            return response()->json([
                'message' => 'Payroll record created successfully',
                'data' => $payroll
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified payroll record.
     */
    public function show($id)
    {
        try {
            $payroll = Payroll::with('employee')->findOrFail($id);
            return response()->json($payroll, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Payroll record not found'], 404);
        }
    }

    /**
     * Update the specified payroll record.
     */
    public function update(Request $request, $id)
    {
        try {
            $payroll = Payroll::findOrFail($id);

            $params = $request->validate([
                'employee_id' => 'required|integer|exists:employees,id',
                'total_earnings' => 'required|numeric|min:0',
                'total_deductions' => 'required|numeric|min:0',
                'pay_date' => 'required|date',
                'status' => 'required|string|min:2|max:60'
            ]);

            // Recalculate net salary
            $params['net_salary'] = $params['total_earnings'] - $params['total_deductions'];

            $payroll->update($params);

            return response()->json([
                'message' => 'Payroll record updated successfully',
                'data' => $payroll
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Payroll record not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong', 'details' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified payroll record.
     */
    public function destroy($id)
    {
        try {
            $payroll = Payroll::findOrFail($id);
            $payroll->delete();

            return response()->json([
                'message' => "Payroll record ID {$id} deleted successfully"
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Payroll record not found'], 404);
        }
    }
}
