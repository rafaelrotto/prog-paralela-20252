<?php

namespace App\Http\Repositories;

use App\Models\User;

class UserRepository
{
    public function __construct(private User $model)
    {}

    public function index(array $data)
    {
        return $this->model->where('name', 'like', '%' . $data['name'] . '%')->get();
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }
}