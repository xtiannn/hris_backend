<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {

            if ($request->has('paginate')) {

                $validate = $request->validate([
                    'paginate' => ['numeric']
                ]);

                $designations = Designation::paginate($validate['paginate']);
            } else {
                $designations = Designation::get();
            }

            return response()->json($designations, 200);
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
                'department_id' => 'required|integer|exists:departments,id',
                'designation' => 'required|string|min:2|max:60'
            ]);

            // Create Designation
            $data = Designation::create($params);

            return response()->json([
                'message' => 'Designation created successfully',
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
        // Find designation with department
        $designation = Designation::with('department')->find($id);

        if (!$designation) {
            return response()->json(['error' => 'Designation not found'], 404);
        }

        return response()->json($designation, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Find designation
            $designation = Designation::find($id);
            if (!$designation) {
                return response()->json(['error' => 'Designation not found'], 404);
            }

            // Validation
            $params = $request->validate([
                'department_id' => 'integer|exists:departments,id',
                'designation' => 'string|min:2|max:60'
            ]);

            // Update designation
            $designation->update($params);

            return response()->json([
                'message' => 'Designation updated successfully',
                'data' => $designation
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
        // Find designation
        $designation = Designation::find($id);

        if (!$designation) {
            return response()->json(['error' => 'Designation not found'], 404);
        }

        // Delete designation
        $designation->delete();

        return response()->json(['message' => 'Designation deleted successfully'], 200);
    }
}
