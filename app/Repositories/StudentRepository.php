<?php

namespace App\Repositories;

use App\Interfaces\StudentInterface;
use App\Models\Student;

class StudentRepository implements StudentInterface
{
    public function __construct(protected Student $student) {}

    public function index()
    {
        return $this->student->with('room')->get();
    }

    public function show($id)
    {
        return $this->student->find($id);
    }

    public function store(array $request)
    {
        return $this->student->create($request);
    }

    public function update($request, $id)
    {
        $student = $this->student->find($id);

        if (!$student) {
            return null;
        }

        $updated = $student->update($request);

        if (!$updated) {
            abort(500, 'failed to update');
        }

        return $student->refresh();
    }



    public function delete($id)
    {
        $student = $this->student->find($id);
        if (!$student) {
            return null;
        }

        $student->delete();
        return true;
    }
}
