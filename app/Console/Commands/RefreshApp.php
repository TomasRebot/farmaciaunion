<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Composer;

class RefreshApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:refresh {seed?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh application';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    protected $composer;
    public function __construct(Composer $composer)
    {
        parent::__construct();
        $this->composer = $composer;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->composer->dumpAutoloads();
        $this->composer->dumpOptimized();
        $this->call('cache:clear');
        $this->call('config:clear');
        $this->call('view:clear');
        $this->call('route:clear');
        $run_dev = shell_exec('npm run dev');
        $dump_autoload = shell_exec('composer dump-autoload');
        if($run_dev)
            $this->info('npm runned in dev');
        if($dump_autoload)
            $this->info('dump autoload ok');


        if($this->argument('seed'))
        {
            $this->call('migrate:fresh');
            $this->call('db:seed');
        }
        $this->info('Cleaned app');
        return true;

    }
}
