<?php

declare(strict_types=1);

namespace LaravelDoctrine\Migrations\Console;

use Illuminate\Console\Command;
use LaravelDoctrine\Migrations\Configuration\DependencyFactoryProvider;

class StatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'doctrine:migrations:status
    {--connection= : For a specific connection.}
    {--show-versions : This will display a list of all available migrations and their status.}';

    /**
     * @var string
     */
    protected $description = 'View the status of a set of migrations.';

    /**
     * Execute the console command.
     *
     * @param DependencyFactoryProvider $provider
     */
    public function handle(DependencyFactoryProvider $provider)
    {
        $dependencyFactory = $provider->getForConnection($this->option('connection'));

        $command = new \Doctrine\Migrations\Tools\Console\Command\StatusCommand($dependencyFactory);
        return $command->run($this->input, $this->output->getOutput());
    }

}
