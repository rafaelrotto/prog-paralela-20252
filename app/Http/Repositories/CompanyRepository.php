<?php

namespace App\Http\Repositories;

use App\Models\Company;

class CompanyRepository extends BaseRepository
{
    public function __construct(Company $model)
    {
        parent::__construct($model);
    }

    public function index(array $data)
    {
        $query = $this->model->where(function ($query) use ($data) {
            if (isset($data['search'])) {
                $query->where('name', 'like', '%' . $data['search'] . '%');
            }
        });

        return isset($data['per_page']) ? $query->paginate($data['per_page']) : $query->get();
    }
}