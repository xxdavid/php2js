<?php
namespace Php2js\Transpilers;

use Php2js\NodesDispatcher;

class FileTranspiler extends AbstractTranspiler
{
    /** @var array */
    private $prependArray = [];

    /**
     * @param array $node
     */
    public function __construct(array $ast)
    {
        $this->ast = $ast;
        $this->scope = $this;
    }

    /**
     * @return string
     */
    public function transpile()
    {
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

    public function prepend($stringToPrepend)
    {
        $this->prependArray[] = $stringToPrepend;
    }
}
