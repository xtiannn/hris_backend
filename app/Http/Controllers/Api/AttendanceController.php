<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attendances = Attendance::all();

        return response()->json($attendances, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate input
            $params = $request->validate([
                'employee_id' => 'required|integer|exists:employees,id',
                'status' => 'required|string|min:2|max:60',
                'date' => 'required|date_format:Y-m-d',
                'time_in' => 'nullable|date_format:H:i:s',
                'time_out' => 'nullable|date_format:H:i:s'
            ]);

            // Store attendance record
            $attendance = Attendance::create($params);

            return response()->json([
                'message' => 'Attendance recorded successfully',
                'data' => $attendance
            ], 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong', 'details' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $attendance = Attendance::find($id);

        if (!$attendance) {
            return response()->json(['error' => 'Attendance record not found'], 404);
        }

        return response()->json($attendance, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $attendance = Attendance::find($id);

            if (!$attendance) {
                return response()->json(['error' => 'Attendance record not found'], 404);
            }

            // Validate input
            $params = $request->validate([
                'employee_id' => 'required|integer|exists:employees,id',
                'status' => 'required|string|min:2|max:60',
                'date' => 'required|date_format:Y-m-d',
                'time_in' => 'nullable|date_format:H:i:s',
                'time_out' => 'nullable|date_format:H:i:s'
            ]);

            // Update attendance record
            $attendance->update($params);

            return response()->json([
                'message' => 'Attendance updated successfully',
                'data' => $attendance
            ], 200);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong', 'details' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $attendance = Attendance::find($id);

            if (!$attendance) {
                return response()->json(['error' => 'Attendance record not found'], 404);
            }

            $attendance->delete();

            return response()->json(['message' => "Attendance record deleted successfully"], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong', 'details' => $e->getMessage()], 500);
        }
    }
}
