<?php

namespace App\Http\Repositories;

use App\Models\Discipline;
use Illuminate\Database\Eloquent\Model;

class DisciplineRepository extends BaseRepository
{

    public function __construct(Discipline $model)
    {
        parent::__construct($model);
    }

    public function index(array $data)
    {
        $query = $this->model->where(function ($query) use ($data) {
            if (isset($data['search'])) {
                $query->where('name', 'like', '%' . $data['search'] . '%');
            }
            if (isset($data['company_id'])) {
                $query->where('company_id', $data['company_id']);
            }
        });

        return isset($data['per_page']) ? $query->paginate($data['per_page']) : $query->get();
    }
}
