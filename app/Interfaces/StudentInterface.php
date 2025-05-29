<?php

namespace App\Interfaces;

interface StudentInterface
{
    public function index();
    public function show($id);
    public function store(array $request);
    public function update($request, $id);
    public function delete($id);
}
