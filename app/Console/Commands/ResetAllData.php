<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;

class ResetAllData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reset-all-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This commands resets all data in the database and in the storage.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (!$this->confirm('⚠️ This will DELETE all uploads and WIPE the database! Do you want to continue?', false)) {
            $this->info('Operation canceled.');
            return;
        }

        $directories = [
            'uploads/patients/profile-photos',
            'uploads/hmo-providers/logos',
        ];

        foreach ($directories as $directory) {
            if (Storage::disk('public')->exists($directory))
            {
                $files = Storage::disk('public')->files($directory);
                Storage::disk('public')->delete($files);
                $this->info("Cleared files in: $directory");
            }
        }

        Artisan::call('db:wipe');
        Artisan::call('migrate --seed');

        foreach ($directories as $directory) {
            Storage::disk('public')->makeDirectory($directory);
            $this->info("Recreated directory: $directory");
        }

        $this->info('Database data and storage have been reset');
    }
}
