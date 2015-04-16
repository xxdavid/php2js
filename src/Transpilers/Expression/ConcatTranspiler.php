<?php
namespace Php2js\Transpilers\Expression;

use Php2js\Transpilers\AbstractTranspiler;
use Php2js\NodesDispatcher;

class ConcatTranspiler extends AbstractTranspiler
{
    /**
     * @return string
     */
    public function transpile()
    {
        $dispatcher = new NodesDispatcher([$this->node->left, $this->node->right]);
        $dispatcher->setContext($this);
        $expressions = $dispatcher->dispatch();
        return $expressions[0] . ' + ' . $expressions[1];
    }
}
