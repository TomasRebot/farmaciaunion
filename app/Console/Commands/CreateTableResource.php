<?php

namespace App\Console\Commands;

use App\Console\generators\TableResourceGenerator;
use Illuminate\Console\Command;

class CreateTableResource extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'table:resource  {resource}' ;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    protected $modeler;
    public function __construct(TableResourceGenerator $generator)
    {
        parent::__construct();
        $this->modeler   = $generator;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('resource');

        $this->writeModel($name);

    }

    protected function writeModel($name) {
        $output = pathinfo($this->modeler->create($name, $this->getModelsPath()), PATHINFO_FILENAME);

        $this->line("      <fg=green;options=bold>create</fg=green;options=bold>  $output");
    }

    protected function getModelsPath() {
        return realpath(__DIR__ . '/../../Core/DynamicTableResources/');
    }
}
