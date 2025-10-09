<?php

namespace App\Http\Services;

use App\Http\Repositories\UserRepository;
use App\Jobs\ExportUserCsvJob;
use Illuminate\Support\Facades\Hash;

class UserService extends BaseService
{
    public function __construct(private readonly UserRepository $userRepository)
    {
        parent::__construct($userRepository);
    }

    public function index(array $data)
    {
        return $this->userRepository->index($data);
    }

    public function find(string $id)
    {
        return $this->userRepository->find($id);
    }

    public function exportCsv(array $data): array
    {
        dispatch(new ExportUserCsvJob($this->userRepository->index($data)));

        return [
            'status' => 200,
            'message' => 'Exportando dados para o csv'
        ];
    }

    public function login(array $data)
    {
        $user = $this->userRepository->findByEmail($data['email']);

        if (!$user || !Hash::check($data['password'], $user->password)) {
            abort(403, 'Erro ao fazer login. Tente novamente!');
        }

        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'token' => $user->createToken('auth_token')->plainTextToken
        ];
    }
}