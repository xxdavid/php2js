<?php
namespace Php2js;

use Php2js\Transpilers\FileTranspiler;

class Transpiler
{
    /** @var Configuration */
    private $configuration;

    public function __construct()
    {
        $this->configuration = new Configuration();
    }

    /**
     * @param $phpCodeString
     * @throws \Exception
     */
    public function transpile($phpCode)
    {
        $parser = new \PhpParser\Parser(new \PhpParser\Lexer);

        $ast = $parser->parse($phpCode);

        $transpiler = new FileTranspiler($ast);
        $transpiler->setConfiguration($this->configuration);
        $result = $transpiler->transpile();

        return $result;
    }

    /**
     * @param Configuration $configuration
     */
    public function setConfiguration($configuration)
    {
        $this->configuration = $configuration;
    }
}
