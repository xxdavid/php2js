<?php
namespace Php2js\Transpilers\Expression\Operators\Logical;

use Php2js\NodeDispatcher;
use Php2js\Transpilers\AbstractTranspiler;

class NegationTranspiler extends AbstractTranspiler
{
    /**
     * @return string
     */
    public function transpile()
    {
        $dispatcher = new NodeDispatcher($this->node->expr);
        $dispatcher->setContext($this);
        $expression = $dispatcher->dispatch();
        return "!($expression)";
    }
}
