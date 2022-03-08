<?php

namespace App\Repositories;

use App\Interfaces\BaseInterface;
use Illuminate\Database\Eloquent\Model;
use Exception;

abstract class BaseRepository implements BaseInterface
{
    /**
     * @var model
     */
    protected $model;

    /**
     * Constructor
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function store(array $data): Model
    {
        return $this->model->create($data);
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getById($id): ?Model
    {
        return $this->model->find($id);
    }

    public function update(array $data, $id)
    {
        $result = $this->model->where(['id' => $id])->update($data);
        if (!$result) {
            throw new Exception(__('messages.error.not_found', ['RECORD' => 'record']), 404);
        };

        return $this->getById($id);
    }

    public function destroy($id)
    {
        $result = $this->getById($id);

        if (!$result) {
            throw new Exception(__('messages.error.not_found', ['RECORD' => 'record']), 404);
        };

        $result =  $result->delete();

        return $result;
    }

    public function findAllWhere($data)
    {
        return $this->model::where($data)->get();
    }
}
