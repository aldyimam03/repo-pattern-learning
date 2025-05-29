<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Services\StudentService;
use Illuminate\Http\JsonResponse;

class StudentController
{
    /**
     * Class constructor.
     */
    public function __construct(protected StudentService $studentService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        try {
            $students = $this->studentService->index();
            return response()->json($students, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve students',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'age'=> 'required|integer'
            ]);

            $student = $this->studentService->store($request);

            return response()->json([
                'message' => 'Student created successfully',
                'data' => $student,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create student',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        try {
            $student = $this->studentService->show($id);
            if (!$student) {
                return response()->json([
                    'message' => 'Student not found',
                ], 404);
            }

            return response()->json($student, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve student',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        try {
            $request->validate([
                'name' => 'sometimes|required|string',
                'room_id' => 'exists:rooms,id',
            ]);

            $student = $this->studentService->update($request, $id);

            if (!$student) {
                return response()->json([
                    'message' => 'Student not found',
                ], 404);
            }

            return response()->json([
                'message' => 'Student updated successfully',
                'data' => $student,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update student',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $student = $this->studentService->delete($id);
            if (!$student) {
                return response()->json([
                    'message' => 'Student not found',
                ], 404);
            }

            return response()->json([
                'message' => 'Student deleted successfully',
                'data' => $student,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete student',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
