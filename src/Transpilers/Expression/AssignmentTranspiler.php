<?php
namespace Php2js\Transpilers\Expression;

use Php2js\NodesDispatcher;
use Php2js\Transpilers\AbstractTranspiler;

class AssignmentTranspiler extends AbstractTranspiler
{
    /**
     * @return string
     */
    public function transpile()
    {
        $expressionDispatcher = new NodesDispatcher([$this->node->var, $this->node->expr]);
        $expressionDispatcher->setContext($this);
        list($variable, $expression) = $expressionDispatcher->dispatch();

        return "$variable = $expression;";
    }
}
