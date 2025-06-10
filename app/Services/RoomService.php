<?php

namespace App\Services;

use App\Interfaces\RoomInterface;

class RoomService
{
    public function __construct(protected RoomInterface $roomInterface) {}

    public function index()
    {
        return $this->roomInterface->index();
    }

    public function store($request)
    {

       $data = $request->validated();

        return $this->roomInterface->store($data);
    }

    public function show($id)
    {
        return $this->roomInterface->show($id);
    }

    public function update($request, $id)
    {

        $data = [
            'name' => $request->name,
        ];

        return $this->roomInterface->update($data, $id);
    }

    public function delete($id)
    {
        return $this->roomInterface->delete($id);
    }
}
