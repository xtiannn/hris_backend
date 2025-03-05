<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payslip;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PayslipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $result = Payslip::with(['employee', 'payroll'])->get(); // Eager loading
        // return response()->json($result, 200);

        try {
            $validate = $request->validate([
                'paginate' => ['numeric']
            ]);

            if ($request->has('paginate')) {
                $result = Payslip::with(['employee', 'payroll'])->paginate($validate['paginate']);
            } else {
                $result = Payslip::with(['employee', 'payroll'])->get();
            }

            return response()->json($result, 200);
        } catch (HttpException $e) {
            return response()->json([
                'error' => 'Something went wrong!',
                'details' => $e->getMessage()
            ], $e->getStatusCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $params = $request->validate([
                'payroll_id' => 'required|integer|exists:payrolls,id',
                'employee_id' => 'required|integer|exists:employees,id',
                'salary_id' => 'required|integer|exists:salaries,id',
                'gross_salary' => 'required|numeric|min:0',
                'meal_allowance' => 'nullable|numeric|min:0',
                'transpo_allowance' => 'nullable|numeric|min:0',
                'deductions' => 'required|numeric|min:0',
                'issued_date' => 'required|date',
                'payment_method' => 'required|string|min:2|max:50'
            ]);

            // Auto-calculate net salary
            $params['net_salary'] = ($params['gross_salary'] + ($params['meal_allowance'] ?? 0) + ($params['transpo_allowance'] ?? 0)) - $params['deductions'];

            $payslip = Payslip::create($params);

            return response()->json([
                'message' => 'Payslip created successfully',
                'data' => $payslip
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $payslip = Payslip::with(['employee', 'payroll'])->findOrFail($id);
            return response()->json($payslip, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Payslip not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $payslip = Payslip::findOrFail($id);

            $params = $request->validate([
                'payroll_id' => 'required|integer|exists:payrolls,id',
                'employee_id' => 'required|integer|exists:employees,id',
                'salary_id' => 'required|integer|exists:salaries,id',
                'gross_salary' => 'required|numeric|min:0',
                'meal_allowance' => 'nullable|numeric|min:0',
                'transpo_allowance' => 'nullable|numeric|min:0',
                'deductions' => 'required|numeric|min:0',
                'issued_date' => 'required|date',
                'payment_method' => 'required|string|min:2|max:50'
            ]);

            // Recalculate net salary
            $params['net_salary'] = ($params['gross_salary'] + ($params['meal_allowance'] ?? 0) + ($params['transpo_allowance'] ?? 0)) - $params['deductions'];

            $payslip->update($params);

            return response()->json([
                'message' => 'Payslip updated successfully',
                'data' => $payslip
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Payslip not found'], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $payslip = Payslip::findOrFail($id);
            $payslip->delete();

            return response()->json([
                'message' => "Payslip ID {$id} deleted successfully"
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Payslip not found'], 404);
        }
    }
}
