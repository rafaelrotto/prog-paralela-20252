<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CheckUserStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-user-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletar usuários inativos';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        User::query()->where('status', 'inactive')->delete();
    }
}
