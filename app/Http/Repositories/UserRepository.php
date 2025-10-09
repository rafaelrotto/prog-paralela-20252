<?php

namespace App\Http\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function builder()
    {
        return auth()->user()->type === 'admin'
            ? $this->model->newQuery()
            : $this->model->where('company_id', auth()->user()->company_id);
    }

    public function index(array $data)
    {
        $query = $this->builder()->where(function ($query) use ($data) {
            if (isset($data['search'])) {
                $query->where('name', 'like', '%' . $data['search'] . '%')
                    ->orWhere('email', 'like', '%' . $data['search'] . '%');
            }

            if (isset($data['status'])) {
                $query->where('status', $data['status']);
            }

            if (isset($data['user_id'])) {
                $query->where('id', $data['user_id']);
            }
        });

        return isset($data['per_page']) ? $query->paginate($data['per_page']) : $query->get();
    }

    public function find(string $id)
    {
        return $this->builder()->findOrFail($id);
    }

    public function findByEmail(string $email)
    {
        return $this->builder()->where('email', $email)->first();
    }
}