<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class DepartmentController extends Controller
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

            // Query Key
            if ($request->has('paginate')) {
                $paginate = $validate;
                $departments = Department::paginate($paginate);
            } else {
                $departments = Department::get();
            }



            return response()->json($departments, 200);

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
            // Validation
            $params = $request->validate([
                'department' => 'required|string|min:2|max:50'
            ]);

            // Business Logic
            $data = Department::create($params);

            // Response
            return response()->json([
                'message' => 'Department created successfully',
                'data' => $data
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
        $department = Department::find($id);

        if (!$department) {
            return response()->json(['error' => 'Department not found'], 404);
        }

        return response()->json($department, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $department = Department::find($id);

            if (!$department) {
                return response()->json(['error' => 'Department not found'], 404);
            }

            // Validation
            $params = $request->validate([
                'department' => 'required|string|min:2|max:50'
            ]);

            // Update department
            $department->update($params);

            return response()->json([
                'message' => 'Department updated successfully',
                'data' => $department
            ], 200);
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
            $department = Department::find($id);

            if (!$department) {
                return response()->json(['error' => 'Department not found'], 404);
            }

            $department->delete();

            return response()->json(['message' => 'Department deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
