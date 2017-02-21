<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;

class Refresh extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh project files';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // exec('composer.bat');
        exec('composer dump-autoload');
        Artisan::call('clear-compiled');
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        Artisan::call('log:clear');
        Artisan::call('session:clear');
        Artisan::call('optimize');
        // Artisan::call('auth:clear-resets'); // borra los datos de la tabla "password_reset"
        $this->info("FILES REFRESHED!!");
    }

    
}
