<?php

namespace App\Http\Services;

use App\Http\Repositories\CompanyRepository;
use App\Http\Repositories\DisciplineRepository;

class DisciplineService extends BaseService
{

    public function __construct(private readonly DisciplineRepository $disciplineRepository)
    {
        parent::__construct($disciplineRepository);
    }

    public function index(array $data)
    {
        return $this->disciplineRepository->index($data);
    }
}
