<?php
namespace App\Console\generators;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

abstract class BaseGenerator {

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files = NULL;

    /**
     * Create a new MigrationGenerator instance.
     *
     * @param \Illuminate\Filesystem\Filesysmte $files
     * @return void
     */
    function __construct(Filesystem $files) {
        $this->files = $files;
    }


    public function getStubPath() {

        return realpath(__DIR__ . '/../stubs');
    }

    public function getFilesystem() {
        return $this->files;
    }


    protected function getStub($name) {
        if ( stripos($name, '.php') === FALSE )
            $name = $name . '.php';

        return $this->files->get($this->getStubPath() . '/' . $name);
    }


    protected function parseStub($stub, $replacements=array()) {
        $output = $stub;

        foreach ($replacements as $key => $replacement) {
            $search = '{{'.$key.'}}';

            $output = str_replace($search, $replacement, $output);

        }

        return $output;
    }

    /**
     * Inflect to a class name
     *
     * @param string $input
     * @return string
     */
    protected function classify($input) {
        return  Str::studly(Str::singular($input));
    }

    /**
     * Inflect to table name
     *
     * @param string $input
     * @return string
     */
    protected function tableize($input) {
        return Str::snake(Str::plural($input));
    }
}
