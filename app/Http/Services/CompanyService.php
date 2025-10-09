<?php

namespace App\Http\Services;

use App\Http\Repositories\CompanyRepository;

class CompanyService extends BaseService
{
    public function __construct(private readonly CompanyRepository $userRepository)
    {
        parent::__construct($userRepository);
    }

    public function index(array $data)
    {
        return $this->userRepository->index($data);
    }
}
