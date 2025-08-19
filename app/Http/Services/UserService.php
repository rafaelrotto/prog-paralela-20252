<?php

namespace App\Http\Services;

use App\Http\Repositories\UserRepository;
use App\Jobs\ExportUserCsvJob;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserService
{
    public function __construct(private readonly UserRepository $userRepository)
    {}


    public function exportCsv(array $data): array
    {
        dispatch(new ExportUserCsvJob($this->userRepository->index($data)));

        return [
            'status' => 200,
            'message' => 'Exportando dados para o csv'
        ];
    }
}