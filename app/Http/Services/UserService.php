<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserService
{
    public function exportCsv(array $data): array
    {
        $filename = '/csv/file_' . now()->toTimeString() . '.csv';
        
        $handle = fopen('php://temp', 'r+');

        fwrite($handle, "\xEF\xBB\xBF");

        fputcsv($handle, ["Id", "Nome", "Email", "Status", "Data de Criação"], ';');

        User::chunk(1000, function ($users) use ($handle) {
            foreach ($users as $user) {
                fputcsv($handle, [
                    $user->id,
                    $user->name,
                    $user->email,
                    $user->status,
                    $user->created_at->format('d-m-Y H:i:s')
                ], ';');
            }
        });

        rewind($handle);

        $csvContent = stream_get_contents($handle);

        Storage::disk('s3')->put($filename, $csvContent);

        return [
            'status' => 200,
            'url' => Storage::disk('s3')->url($filename)
        ];
    }
}