<?php

namespace App\Interfaces;

interface BaseInterface
{
    public function store(array $data);

    public function getAll();

    public function getById(int $id);

    public function update(array $data, $id);

    public function destroy($id);

    public function findAllWhere(array $data);

    public function insert(array $data);

    public function multiDestroy(array $where);
}
