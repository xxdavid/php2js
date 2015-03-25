<?php
namespace Php2js\Expression;

use Php2js\AbstractTranspiler;
use Php2js\NodesDispatcher;
use PhpParser\Node;

class DivisionTranspiler extends AbstractTranspiler
{
    /**
     * @return string
     */
    public function transpile()
    {
        $dispatcher = new NodesDispatcher([$this->node->left, $this->node->right]);
        $dispatcher->addPostTranspilationHook(function (Node $node, $result) {
            if ($node->getType() == 'Expr_BinaryOp_Plus' || $node->getType() == 'Expr_BinaryOp_Minus') {
                return '(' . $result . ')';
            }
            return $result;
        });
        $expressions = $dispatcher->dispatch();
        return $expressions[0] . ' / ' . $expressions[1];
    }
}
