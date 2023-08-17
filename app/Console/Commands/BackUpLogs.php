<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use function dd;


class BackUpLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:back-up-logs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Back up logs to SFTP';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (!App::isLocal()) {
            $localDisk = Storage::disk('local');
            $localFiles = $localDisk->allFiles('logs');
            Arr::forget($localFiles, 0);
            $cloudDisk = Storage::disk('sftp');
            $pathPrefix = 'logs' . DIRECTORY_SEPARATOR . Carbon::now() . DIRECTORY_SEPARATOR;
            foreach ($localFiles as $file) {
                $contents = $localDisk->get($file);
                $cloudLocation = $pathPrefix . Str::after($file, '/');
                $cloudDisk->put($cloudLocation, $contents);
                $localDisk->delete($file);
                $localDisk->put('logs/laravel.log','');
                $localDisk->put('logs/sql.log','');
            }
        } else {
            Log::info('BackUpLogs not backing up in local env');
        }
    }
}
