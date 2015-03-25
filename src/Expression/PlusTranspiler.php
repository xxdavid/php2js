<?php
namespace Php2js\Expression;

use Php2js\AbstractTranspiler;
use Php2js\NodesDispatcher;

class PlusTranspiler extends AbstractTranspiler
{
    /**
     * @return string
     */
    public function transpile()
    {
        $dispatcher = new NodesDispatcher([$this->node->left, $this->node->right]);
        $expressions = $dispatcher->dispatch();
        return $expressions[0] . ' + ' . $expressions[1];
    }
}
