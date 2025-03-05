<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Salary;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        try {
            $validate = $request->validate([
                'paginate' => ['numeric']
            ]);

            if ($request->has('paginate')) {
                $salaries = Salary::with('employee')->paginate($validate['paginate']);
            } else {
                $salaries = Salary::with('employee')->get();
            }

            return response()->json($salaries, 200);

        } catch (HttpException $e) {
            return response()->json([
                'error' => 'Something went wrong',
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
                'employee_id' => 'required|integer|exists:employees,id',
                'basic_salary' => 'required|numeric|min:1',
                'pay_period' => 'required|string|min:1|max:255',
                'start_date' => 'required|date',
                'end_date' => 'required|date'

            ]);

            $salary = Salary::create($params);

            return response()->json([
                'message' => 'Salary record created successfully',
                'data' => $salary
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
            $salary = Salary::with('employee')->findOrFail($id);
            return response()->json([
                'message' => 'Salary record found',
                'data' => $salary
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Salary record not found'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $salary = Salary::findOrFail($id);

            $params = $request->validate([
                'employee_id' => 'required|integer|exists:employees,id',
                'basic_salary' => 'required|numeric|min:1',
                'basic_period' => 'required|string|min:1|max:255',
                'start_date' => 'required|date',
                'end_date' => 'required|date'

            ]);

            $salary->update($params);

            return response()->json([
                'message' => 'Salary record updated successfully',
                'data' => $salary
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Salary record not found'
            ], 404);
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
            $salary = Salary::findOrFail($id);
            $salary->delete();

            return response()->json([
                'message' => "Salary record ID {$id} deleted successfully"
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Salary record not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
