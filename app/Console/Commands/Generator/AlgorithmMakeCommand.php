<?php

namespace App\Console\Commands\Generator;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(name: 'make:algorithm')]
class AlgorithmMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:algorithm';

    /**
     * The name of the console command.
     *
     * This name is used to identify the command during lazy loading.
     *
     * @var string|null
     *
     * @deprecated
     */
    protected static $defaultName = 'make:algorithm';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Algorithm class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Algorithm';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('without-abstract')) {
            return $this->resolveStubPath('/stubs/algorithm.without.stub');
        }

        return $this->resolveStubPath('/stubs/algorithm.stub');
    }

    /**
     * Resolve the fully-qualified path to the stub.
     *
     * @param  string  $stub
     * @return string
     */
    protected function resolveStubPath($stub)
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath
            : __DIR__.$stub;
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Algorithms';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['without-abstract', 'w', InputOption::VALUE_NONE, 'Generate a algorithm without extends abstract class'],
        ];
    }
}
