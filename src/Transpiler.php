<?php
namespace Php2js;

use Php2js\Transpilers\FileTranspiler;

class Transpiler
{
    public $configuration;

    /**
     * @param $phpCodeString
     * @throws \Exception
     */
    public function transpile($phpCode)
    {
        $parser = new \PhpParser\Parser(new \PhpParser\Lexer);

        $ast = $parser->parse($phpCode);

        $transpiler = new FileTranspiler($ast);
        $transpiler->setContext($this);
        $result = $transpiler->transpile();

        return $result;
    }
}
