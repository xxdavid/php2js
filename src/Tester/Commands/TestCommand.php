<?php
namespace Php2js\Tester\Commands;

use Nette\Utils\Finder;
use Php2js\Tester\Helpers;
use Php2js\Tester\Runner;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Tracy\Debugger;

class TestCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('test')
            ->setDescription('Run tests')
            ->addArgument(
                'path',
                InputArgument::OPTIONAL,
                'Path to the test file or directory',
                __DIR__ . '/../../../tests/'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        Debugger::timer();
        $output->writeln('Running tests...');

        $runner = new Runner();

        $path = realpath($input->getArgument('path'));
        if ($path) {
            if (is_dir($path)) {
                $runner->setTestsRoot($path . '/');
                foreach (Finder::findFiles('*.php')->exclude('tester.php')->from($path) as $path => $fileInfo) {
                    $basePath = Helpers::stripExtension($path);
                    $runner->addTest($basePath);
                }
            } else {
                $basePath = Helpers::stripExtension($path);
                $runner->addTest($basePath);
            }
        } else {
            if ($path = realpath($input->getArgument('path') . '.php')) {
                $basePath = Helpers::stripExtension($path);
                $runner->addTest($basePath);
            } else {
                $output->writeln("<error>The given path isn't valid</error>");
                return 1;
            }
        }

        $runner->setOutput($output);
        $runner->runTests();

        $output->writeln('Completed in ' . round(Debugger::timer(), 2) . ' seconds');
        if ($runner->failed()) {
            return 1;
        } else {
            return 0;
        }
    }
}
