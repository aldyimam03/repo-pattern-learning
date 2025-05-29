<?php

namespace App\Repositories;

use App\Interfaces\RoomInterface;
use App\Models\Room;

class RoomRepository implements RoomInterface
{
    public function __construct(protected Room $room) {}

    public function index()
    {
        return $this->room->with('students')->get();
    }

    public function show($id)
    {
        return $this->room->find($id);
    }

    public function store(array $request)
    {
        return $this->room->create($request);
    }

    public function update($request, $id)
    {
        $room = $this->room->find($id);
        if (!$room) {
            return null;
        }

        $room->update($request);
        return $room;
    }

    public function delete($id)
    {
        $room = $this->room->find($id);
        if (!$room) {
            return null;
        }

        $room->delete();
        return true;
    }
}
