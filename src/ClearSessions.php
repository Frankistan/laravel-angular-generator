<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;


class ClearSessions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'session:clear {--keep-last : Whether the last log file should be kept}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove every session files in the session directory';
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
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $path = $this->laravel['config']['session.files'];

        if (! $path) {
            throw new RuntimeException('Session path not found.');
        }

        foreach ($this->files->glob("{$path}/*") as $session) {
            $this->files->delete($session);
        }

        $this->info('All session files cleared!');
    }

    
}
