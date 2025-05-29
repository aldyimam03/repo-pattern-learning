<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Services\RoomService;
use Illuminate\Http\JsonResponse;

class RoomController
{
    public function __construct(protected RoomService $roomService) {}

    /**
     * Display a listing of the resource.
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
    public function store(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'name' => 'required|string|unique:rooms,name',
            ]);

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
    public function update(Request $request, string $id): JsonResponse
    {
        try {
            $request->validate([
                'name' => 'required|string|unique:rooms,name,' . $id,
            ]);

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
