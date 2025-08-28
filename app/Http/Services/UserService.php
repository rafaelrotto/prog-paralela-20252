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

    public function index(array $data)
    {
        return $this->userRepository->index($data);
    }

    public function store(array $data)
    {
        return $this->userRepository->store($data);
    }

    public function show(string $id)
    {
        return $this->userRepository->show($id);
    }

    public function update(array $data, string $id)
    {
        return $this->userRepository->update($data, $id);
    }

    public function destroy(string $id)
    {
        $this->userRepository->destroy($id);
    }

    public function exportCsv(array $data): array
    {
        dispatch(new ExportUserCsvJob($this->userRepository->index($data)));

        return [
            'status' => 200,
            'message' => 'Exportando dados para o csv'
        ];
    }
}