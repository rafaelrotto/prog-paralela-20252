<?php

namespace App\Jobs;

use App\Events\UserCsvCreated;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ExportUserCsvJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private Collection|LengthAwarePaginator $users) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $filename = '/csv/file_' . now()->toTimeString() . '.csv';

        $handle = fopen('php://temp', 'r+');

        fwrite($handle, "\xEF\xBB\xBF");

        fputcsv($handle, ["Id", "Nome", "Email", "Status", "Data de Criação"], ';');

        foreach ($this->users as $user) {
            fputcsv($handle, [
                $user->id,
                $user->name,
                $user->email,
                $user->status,
                $user->created_at->format('d-m-Y H:i:s')
            ], ';');
        }

        rewind($handle);

        $csvContent = stream_get_contents($handle);

        Storage::disk('s3')->put($filename, $csvContent);

        broadcast(new UserCsvCreated(Storage::disk('s3')->url($filename)));
    }
}
