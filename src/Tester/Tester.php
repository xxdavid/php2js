<?php
namespace Php2js\Tester;

use Php2js\Tester\Commands\TestCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;

class Tester extends Application
{
    /**
     * Gets the name of the command based on input.
     *
     * @param InputInterface $input The input interface
     *
     * @return string The command name
     */
    protected function getCommandName(InputInterface $input)
    {
        // This should return the name of your command.
        return 'test';
    }

    /**
     * Gets the default commands that should always be available.
     *
     * @return array An array of default Command instances
     */
    protected function getDefaultCommands()
    {
        // Keep the core default commands to have the HelpCommand
        // which is used when using the --help option
        $defaultCommands = parent::getDefaultCommands();

        $defaultCommands[] = new TestCommand();

        return $defaultCommands;
    }

    /**
     * Overridden so that the application doesn't expect the command
     * name to be the first argument.
     */
    public function getDefinition()
    {
        $inputDefinition = parent::getDefinition();
        // clear out the normal first argument, which is the command name
        $inputDefinition->setArguments();

        return $inputDefinition;
    }

    public static function getPhp2jsRoot()
    {
        return realpath(__DIR__ . '/../../');
    }

    public function getName()
    {
        return 'Php2js Tester';
    }

    public function getVersion()
    {
        return '1.0';
    }
}
