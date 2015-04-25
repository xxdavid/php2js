<?php
namespace Php2js\Transpilers;

use Php2js\AbstractScope;
use Php2js\IndentationManager;
use Php2js\NodesDispatcher;
use Php2js\VariableManager;

class FileTranspiler extends AbstractScope
{
    /**
     * @param array $node
     */
    public function __construct(array $ast)
    {
        $this->ast = $ast;
        $this->setScope($this);
        $this->variableManager = new VariableManager();
    }

    /**
     * @return string
     */
    public function transpile()
    {
        $this->indentationManager = new IndentationManager($this->configuration);
        $dispatcher = new NodesDispatcher($this->ast);
        $dispatcher->setContext($this);
        $transpiledAst = $dispatcher->dispatch();
        $result = '';
        if ($this->prependArray) {
            $result .= join("\n", $this->prependArray);
            $result .= "\n\n";
        }
        $result .= join("\n", $transpiledAst);
        return $result;
    }
}
