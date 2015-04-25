<?php
namespace Php2js\Transpilers\Expression;

use Php2js\NodesDispatcher;
use Php2js\Transpilers\AbstractTranspiler;

class XorTranspiler extends AbstractTranspiler
{
    /**
     * @return string
     */
    public function transpile()
    {
        $dispatcher = new NodesDispatcher([$this->node->left, $this->node->right]);
        $dispatcher->setContext($this);
        list($left, $right) = $dispatcher->dispatch();
        return "($left && !($right)) || (!($left) && $right)";
    }
}
