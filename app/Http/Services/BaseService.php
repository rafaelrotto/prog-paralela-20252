<?php

namespace App\Http\Services;

use App\Http\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class BaseService
{
    private BaseRepository $repository;

    public function __construct(Model $model)
    {
        $this->repository = new BaseRepository($model);
    }

    public function store(array $data)
    {
        return $this->repository->store($data);
    }

    public function show(string $id)
    {
        return $this->repository->show($id);
    }

    public function update(array $data, string $id)
    {
        return $this->repository->update($data, $id);
    }

    public function destroy(string $id)
    {
        $this->repository->destroy($id);
    }
}