<?php
namespace Php2js\Transpilers;

use Php2js\NodeDispatcher;
use Php2js\NodesDispatcher;

class FileTranspiler extends AbstractTranspiler
{
    /**
     * @param array $node
     */
    public function __construct(array $ast)
    {
        $this->ast = $ast;
    }


    /**
     * @return string
     */
    public function transpile()
    {
        $dispatcher = new NodesDispatcher($this->ast);
        $dispatcher->setContext($this);
        $transpiledAst = $dispatcher->dispatch();
        $result = join("\n", $transpiledAst);
        return $result;
    }
}
