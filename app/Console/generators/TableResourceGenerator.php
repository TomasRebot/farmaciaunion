<?php


namespace App\Console\generators;


class TableResourceGenerator extends BaseGenerator
{

    /**
     * Create a new model at the given path.
     *
     * @param string $name
     * @param string $path
     * @return string
     */
    public function create($name, $path)
    {
        $path = $this->getPath($name, $path);

        $stub = $this->getStub('tableresource');

        $this->files->put($path, $this->parseStub($stub, array(
            'class' => $this->classify($name),
            'entity' => "'".$this->classify(str_replace('TableResource', '', $name))."'",
            'resolver' => "'".$this->classify(str_replace('TableResource', '', $name).'Resolver')."'",
            'model' =>$this->classify(str_replace('TableResource', '', $name)),
            'routeEntity' => strtolower("'".$this->classify(str_replace('TableResource', '', $name))."'"),
        )));

        return $path;
    }

    /**
     * Get the full path name to the migration.
     *
     * @param string $name
     * @param string $path
     * @return string
     */
    protected function getPath($name, $path)
    {
        return $path . '/' . $this->classify($name) . '.php';
    }

}
