<?php
namespace Php2js;

class Transpiler
{
    /**
     * @param $phpCodeString
     * @throws \Exception
     */
    public function transpile($phpCode)
    {
        $parser = new \PhpParser\Parser(new \PhpParser\Lexer);

        $ast = $parser->parse($phpCode);

        $result = '';
        foreach ($ast as $node) {
            $dispatcher = new NodeDispatcher($node);
            $result .= $dispatcher->dispatch();
            if ($node !== end($ast)) {
                $result .= "\n";
            }
        }

        return $result;
    }
}
