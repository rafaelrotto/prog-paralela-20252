<?php

namespace App\Http\Repositories;

use App\Models\User;

class UserRepository
{
    public function __construct(private User $model)
    {}

    public function index(array $data)
    {
        $query = $this->model->where(function ($query) use ($data) {
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

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function show(string $id)
    {
       return $this->model->find($id);
    }

    public function update(array $data, string $id)
    {
        $user = $this->find($id);

        $user->update($data);

        return $user->fresh();
    }

    private function find(string $id)
    {
        return $this->model->findOrFail($id);
    }

    public function destroy(string $id)
    {
        $this->find($id)->delete();
    }

    public function findByEmail(string $email)
    {
        return $this->model->where('email', $email)->first();
    }
}