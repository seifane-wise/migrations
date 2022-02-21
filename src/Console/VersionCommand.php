<?php

declare(strict_types=1);

namespace LaravelDoctrine\Migrations\Console;

use Illuminate\Console\Command;
use LaravelDoctrine\Migrations\Configuration\DependencyFactoryProvider;

class VersionCommand extends Command
{
    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'doctrine:migrations:version {version?}
    {--connection= : For a specific connection.}
    {--add : Add the specified version }
    {--delete : Delete the specified version.}
    {--all : Apply to all the versions.}
    {--range-from= : Apply from specified version. }
    {--range-to= : Apply to specified version. }';

    /**
     * @var string
     */
    protected $description = 'Manually add and delete migration versions from the version table.';

    /**
     * Execute the console command.
     *
     * @param DependencyFactoryProvider $provider
     */
    public function handle(DependencyFactoryProvider $provider)
    {
        $dependencyFactory = $provider->getForConnection($this->option('connection'));

        $command = new \Doctrine\Migrations\Tools\Console\Command\VersionCommand($dependencyFactory);
        return $command->run($this->input, $this->output->getOutput());
    }

}
