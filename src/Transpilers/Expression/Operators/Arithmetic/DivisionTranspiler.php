<?php
namespace Php2js\Transpilers\Expression\Operators\Arithmetic;

use Php2js\Transpilers\AbstractTranspiler;
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
        $dispatcher->setContext($this);
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
