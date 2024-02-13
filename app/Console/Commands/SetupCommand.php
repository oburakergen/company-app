<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SetupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info("Setup Start \n");

        try {
            $this->info("Call Migrate:fresh");
            Artisan::call("migrate:fresh");

            $this->info("Call db:seed");
            Artisan::call("db:seed");

            $this->alert("Admin Info \n user: admin@admin.com \n pass: password");
            $this->info('Setup End');
        } catch (\Exception $exception) {
            $this->warn($exception->getMessage()."\nSetupCommand.php ". $this->verbosity. " line");
        }
    }
}
