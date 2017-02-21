<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;

class ClearLogs extends Command
{
    protected $path;
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:clear';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove every log files in the log directory';
     /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * Create a new config clear command instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
        $this->path = storage_path('logs');
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        if (! $this->path) {
            throw new RuntimeException('Logs path not found.');
        }

        foreach ($this->files->glob("{$this->path}/*") as $log) {
            $this->files->delete($log);
        }

        $this->info('All log files cleared!');
    }   
}
