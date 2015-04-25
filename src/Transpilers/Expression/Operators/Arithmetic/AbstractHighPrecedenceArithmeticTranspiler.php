<?php
namespace Php2js\Transpilers\Expression\Operators\Arithmetic;

use Php2js\NodesDispatcher;
use Php2js\Transpilers\AbstractTranspiler;
use PhpParser\Node;

abstract class AbstractHighPrecedenceArithmeticTranspiler extends AbstractTranspiler
{
    /**
     * @param string $left
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
        $dispatcher->addPostTranspilationHook(function (Node $node, $result) {
            if ($node->getType() == 'Expr_BinaryOp_Plus' || $node->getType() == 'Expr_BinaryOp_Minus') {
                return '(' . $result . ')';
            }
            return $result;
        });
        $expressions = $dispatcher->dispatch();
        return $this->join($expressions[0], $expressions[1]);
    }
}
