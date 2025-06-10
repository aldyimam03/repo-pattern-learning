<?php

namespace App\Services;

use App\Interfaces\StudentInterface;

class StudentService
{
    public function __construct(protected StudentInterface $studentInterface) {}

    public function index()
    {
        $students = $this->studentInterface->index();

        return $students->map(function ($student) {
            return [
                'id' => $student->id,
                'name' => $student->name,
                'age' => $student->age,
                'room_name' => $student->room->name ?? null,
            ];
        });
    }

    public function store($request)
    {

        // CARA LAMA DAN KURANG EFISIEN
        // $data = [
        //     'name' => $request->name,
        //     'age' => $request->age,
        //     'room_id' => $request->room_id,
        // ];

        // CARA BARU DAN LEBIH EFISIEN 
        $data = $request->validated();

        return $this->studentInterface->store($data);
    }

    public function show($id)
    {
        $student = $this->studentInterface->show($id);

        if (!$student) return null;

        return [
            'id' => $student->id,
            'name' => $student->name,
            'age' => $student->age,
            'room_name' => $student->room->name ?? null,
        ];
    }

    public function update($request, $id)
    {

        $data = [
            'name' => $request->name,
            'age' => $request->age,
            'room_id' => $request->room_id
        ];

        return $this->studentInterface->update($data, $id);
    }

    public function delete($id)
    {
        return $this->studentInterface->delete($id);
    }
}
