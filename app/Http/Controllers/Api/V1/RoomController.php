<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Services\RoomService;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Tag(
 *     name="Room",
 *     description="API untuk manajemen ruang (room)"
 * )
 */

class RoomController
{
    public function __construct(protected RoomService $roomService) {}

    /**
     * Display a listing of the resource.
     */

    /**
     * @OA\Get(
     *     path="/api/room",
     *     tags={"Room"},
     *     summary="Get all rooms",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of rooms"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Failed to retrieve rooms"
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        try {
            $rooms = $this->roomService->index();
            return response()->json($rooms, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve rooms',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */

    /**
     * @OA\Post(
     *     path="/api/room",
     *     tags={"Room"},
     *     summary="Create new room",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="Ruang A")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Room created successfully"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Failed to create room"
     *     )
     * )
     */
    public function store(StoreRoomRequest $request): JsonResponse
    {
        try {
            $room = $this->roomService->store($request);

            return response()->json([
                'message' => 'Room created successfully',
                'data' => $room
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create room',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */

    /**
     * @OA\Get(
     *     path="/api/room/{id}",
     *     tags={"Room"},
     *     summary="Get detail room by ID",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Room detail"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Room not found"
     *     )
     * )
     */
    public function show(string $id): JsonResponse
    {
        try {
            $result = $this->roomService->show($id);
            if (!$result) {
                return response()->json([
                    'message' => 'Room not found'
                ], 404);
            }

            return response()->json($result, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve room',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */

    /**
     * @OA\Put(
     *     path="/api/room/{id}",
     *     tags={"Room"},
     *     summary="Update room by ID",
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
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="Ruang B")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Room updated successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Room not found"
     *     )
     * )
     */
    public function update(UpdateRoomRequest $request, string $id): JsonResponse
    {
        try {

            $updated = $this->roomService->update($request, $id);

            if (!$updated) {
                return response()->json([
                    'message' => 'Room not found'
                ], 404);
            }

            return response()->json([
                'message' => 'Room updated successfully',
                'data' => $updated
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update room',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */

    /**
     * @OA\Delete(
     *     path="/api/room/{id}",
     *     tags={"Room"},
     *     summary="Delete room by ID",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Room deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Room not found"
     *     )
     * )
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $deleted = $this->roomService->delete($id);

            if (!$deleted) {
                return response()->json([
                    'message' => 'Room not found'
                ], 404);
            }

            return response()->json([
                'message' => 'Room deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete room',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
