<?php
namespace Php2js\Transpilers\Expression;

use Php2js\Transpilers\AbstractTranspiler;
use Php2js\NodesDispatcher;

class PowerTranspiler extends AbstractTranspiler
{
    /**
     * @return string
     */
    public function transpile()
    {
        $dispatcher = new NodesDispatcher([$this->node->left, $this->node->right]);
        $dispatcher->setContext($this);
        $expression = $dispatcher->dispatch();
        return "Math.pow($expression[0], $expression[1])";
    }
}
