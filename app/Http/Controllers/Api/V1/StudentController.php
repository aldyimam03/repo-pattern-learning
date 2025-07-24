<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Services\StudentService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;

/**
 * @OA\Tag(
 *     name="Student",
 *     description="Manajemen Data Student"
 * )
 */
class StudentController
{
    /**
     * Class constructor.
     */
    public function __construct(protected StudentService $studentService) {}

    /**
     * Display a listing of the resource.
     */

    /**
     * @OA\Get(
     *     path="/api/student",
     *     summary="Ambil semua data student",
     *     tags={"Student"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="List of students"),
     *     @OA\Response(response=500, description="Failed to retrieve students")
     * )
     */
    public function index(): JsonResponse
    {
        try {
            $students = $this->studentService->index();

            return response()->json($students, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create student',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */

    /**
     * @OA\Post(
     *     path="/api/student",
     *     summary="Membuat data student baru",
     *     tags={"Student"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","age","room_id"},
     *             @OA\Property(property="name", type="string", example="Aldy"),
     *             @OA\Property(property="age", type="integer", example=22),
     *             @OA\Property(property="room_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(response=201, description="Student created successfully"),
     *     @OA\Response(response=500, description="Failed to create student")
     * )
     */
    public function store(StoreStudentRequest $request): JsonResponse
    {
        try {

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

    /**
     * @OA\Get(
     *     path="/api/student/{id}",
     *     summary="Ambil data student berdasarkan ID",
     *     tags={"Student"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Student data"),
     *     @OA\Response(response=404, description="Student not found")
     * )
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

    /**
     * @OA\Put(
     *     path="/api/student/{id}",
     *     summary="Update data student",
     *     tags={"Student"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="Aldy Updated"),
     *             @OA\Property(property="age", type="integer", example=23),
     *             @OA\Property(property="room_id", type="integer", example=2)
     *         )
     *     ),
     *     @OA\Response(response=200, description="Student updated successfully"),
     *     @OA\Response(response=404, description="Student not found")
     * )
     */
    public function update(UpdateStudentRequest $request, string $id): JsonResponse
    {
        try {

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

    /**
     * @OA\Delete(
     *     path="/api/student/{id}",
     *     tags={"Student"},
     *     summary="Delete a student",
     *     description="Delete a student by ID. Only accessible by admin.",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the student",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Student deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Student not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     )
     * )
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
