<?php
namespace Php2js\Expression;

use Php2js\AbstractTranspiler;
use Php2js\NodesDispatcher;

class PowerTranspiler extends AbstractTranspiler
{
    /**
     * @return string
     */
    public function transpile()
    {
        //        dump($this->node);
        $dispatcher = new NodesDispatcher([$this->node->left, $this->node->right]);
        $expression = $dispatcher->dispatch();
        return "Math.pow($expression[0], $expression[1])";
    }
}
