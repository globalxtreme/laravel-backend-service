<?php

namespace App\Console\Commands\Generator;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'make:number')]
class NumberMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:number';

    /**
     * The name of the console command.
     *
     * This name is used to identify the command during lazy loading.
     *
     * @var string|null
     *
     * @deprecated
     */
    protected static $defaultName = 'make:number';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Number class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Number';

    /**
     * This stub is for installation
     *
     * @var string
     */
    protected $stubFile;

    /**
     * Execute the console command.
     *
     * @return bool|null
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        $nameInput = $this->getNameInput();

        $stubs = [
            'number.contract.stub' => 'Contract\\' . $nameInput . 'NumberGeneratorContract',
            'number.facade.stub' => 'Facade\\' . $nameInput . 'Number',
            'number.generator.stub' => 'Generator\\' . $nameInput . 'NumberGenerator'
        ];
        foreach ($stubs as $key => $stub) {

            $this->stubFile = $key;

            $name = $this->qualifyClass($stubs[$key]);

            $path = $this->getPath($name);

            // Next, we will generate the path to the location where this class' file should get
            // written. Then, we will build the class and make the proper replacements on the
            // stub files so that it gets the correctly formatted namespace and class name.
            $this->makeDirectory($path);
            $this->info($path);

            $this->files->put($path, $this->sortImports($this->buildClass($name)));

        }

        $this->info($this->type . ' Generator created successfully.');
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return $this->resolveStubPath('/stubs/' . $this->stubFile);
    }

    /**
     * Resolve the fully-qualified path to the stub.
     *
     * @param string $stub
     * @return string
     */
    protected function resolveStubPath($stub)
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath
            : __DIR__ . $stub;
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Services\Number';
    }

    /**
     * Replace the namespace for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
    protected function replaceNamespace(&$stub, $name)
    {
        $searches = [
            ['DummyNamespace', 'DummyRootNamespace', 'NamespacedDummyUserModel', 'DummyNameInput', 'DummyNameInputClass'],
            ['{{ namespace }}', '{{ rootNamespace }}', '{{ namespacedUserModel }}', '{{ nameInput }}', '{{ nameInputClass }}'],
            ['{{namespace}}', '{{rootNamespace}}', '{{namespacedUserModel}}', '{{nameInput}}', '{{nameInputClass}}'],
        ];

        foreach ($searches as $search) {
            $stub = str_replace(
                $search,
                [$this->getNamespace($name), $this->rootNamespace(), $this->userProviderModel(), $this->getNameInput(), $this->getNameInputClass()],
                $stub
            );
        }

        return $this;
    }

    /**
     * Get the desired class name class from the input.
     *
     * @return string
     */
    protected function getNameInputClass()
    {
        $nameInput = last(preg_split('~[\\\\/]~', $this->getNameInput()));
        return trim($nameInput);
    }

}
