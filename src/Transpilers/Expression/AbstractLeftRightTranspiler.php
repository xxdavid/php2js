<?php
namespace Php2js\Transpilers\Expression;

use Php2js\NodesDispatcher;
use Php2js\Transpilers\AbstractTranspiler;

abstract class AbstractLeftRightTranspiler extends AbstractTranspiler
{
    /**
     * @param string$left
     * @param string $right
     * @return string
     */
    abstract protected function join($left, $right);

    /**
     * @return string
     */
    public function transpile()
    {
        $dispatcher = new NodesDispatcher([$this->node->left, $this->node->right]);
        $dispatcher->setContext($this);
        $expressions = $dispatcher->dispatch();
        return $this->join($expressions[0], $expressions[1]);
    }
}
