<?php
namespace Php2js;

use Php2js\Transpilers\FileTranspiler;

class Transpiler
{
    private $configuration;

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
        $transpiler->setVariableManager(new VariableManager());
        $result = $transpiler->transpile();

        return $result;
    }
}
