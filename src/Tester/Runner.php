<?php
namespace Php2js\Tester;

use Php2js\Configuration;
use Php2js\Tester\Entities\Failure;
use Php2js\Transpiler;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;

class Runner
{
    /** @var array */
    private $tests;

    /** @var  OutputInterface */
    private $output;

    /** @var string */
    private $testsRoot;

    /** @var Failure[] */
    private $failures = [];

    public function __construct()
    {
        $this->testsRoot = Tester::getPhp2jsRoot() . 'tests/';
    }

    /**
     * @param string $basePath
     */
    public function addTest($basePath)
    {
        $this->tests[] = $basePath;
    }

    public function runTests()
    {
        $this->setupColors();
        foreach ($this->tests as $basePath) {
            $transpiler = new Transpiler();
            $name = Helpers::stripPrefix($basePath, $this->testsRoot);
            $phpPath = $basePath . '.php';
            $jsPath = $basePath . '.js';
            $yamlPath = $basePath . '.yml';
            if (file_exists($yamlPath)) {
                $configuration = new Configuration();
                $yaml = Yaml::parse(file_get_contents($yamlPath));
                foreach ($yaml as $option => $value) {
                    $configuration->$option = $value;
                }
                $transpiler->setConfiguration($configuration);
            }
            if (file_exists($jsPath)) {
                $expected = file_get_contents($jsPath);
                $generated = $transpiler->transpile(file_get_contents($phpPath));
                if ($expected === $generated) {
                    $this->writeSuccess();
                } else {
                    $this->writeFailure();
                    $this->addFailure($name, $this->generateFailureExplanation($expected, $generated));
                }
            } else {
                $this->addFailure($name, "Not defined JS result file");
            }
        }
        $this->output->writeln('');
        $this->output->writeln('');
        if ($this->failures) {
            $this->writeFailuresExplanation();
            $this->output->writeln('');
        } else {
            $this->output->writeln('<success>All tests have passed 👍</success>');
        }
    }

    /**
     * @param OutputInterface $output
     */
    public function setOutput(OutputInterface $output)
    {
        $this->output = $output;
    }

    /**
     * @param string $testsRoot
     */
    public function setTestsRoot($testsRoot)
    {
        $this->testsRoot = $testsRoot;
    }

    /**
     * @param string $testName
     * @param string $message
     */
    private function addFailure($testName, $message)
    {
        $failure = new Failure();
        $failure->testName = $testName;
        $failure->message = $message;
        $this->failures[] = $failure;
    }

    private function setupColors()
    {
        $successStyle = new OutputFormatterStyle('green');
        $failureStyle = new OutputFormatterStyle('red');
        $expectedStyle = new OutputFormatterStyle('white', 'green');
        $actualStyle = new OutputFormatterStyle('white', 'red');
        $this->output->getFormatter()->setStyle('success', $successStyle);
        $this->output->getFormatter()->setStyle('failure', $failureStyle);
        $this->output->getFormatter()->setStyle('expected', $expectedStyle);
        $this->output->getFormatter()->setStyle('actual', $actualStyle);
    }

    private function writeSuccess()
    {
        $this->output->write('<success>.</success>');
    }

    private function writeFailure()
    {
        $this->output->write('<failure>F</failure>');
    }

    /**
     * @param string $expected
     * @param string $generated
     * @return string
     */
    private function generateFailureExplanation($expected, $generated)
    {
        return <<<EOF
<comment>Expected</comment>
<expected>$expected</expected>

<comment>But php2js generated</comment>
<actual>$generated</actual>
EOF;
    }

    private function writeFailuresExplanation()
    {
        foreach ($this->failures as $failure) {
            $this->output->writeln(<<<EOF
<failure>$failure->testName</failure><comment> failed:</comment>
$failure->message
EOF
            );
            if ($failure != end($this->failures)) {
                $this->output->writeln('');
                $this->output->writeln('');
            }
        }
    }

    public function failed()
    {
        return (count($this->failures) > 0);
    }
}
