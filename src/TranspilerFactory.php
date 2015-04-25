<?php
namespace Php2js;

use Php2js\Exceptions\ContextNotProvidedException;
use Php2js\Exceptions\NotImplementedException;
use Php2js\Transpilers\AbstractTranspiler;
use PhpParser\Node;

class TranspilerFactory
{
    private static $transpilersMap = [
        'Stmt_Echo' => 'Statement\Echo',
        'Scalar_String' => 'Scalar\String',
        'Expr_BinaryOp_Concat' => 'Expression\Concat',
        'Expr_BinaryOp_Div' => 'Expression\Division',
        'Expr_BinaryOp_Minus' => 'Expression\Minus',
        'Expr_BinaryOp_Plus' => 'Expression\Plus',
        'Expr_BinaryOp_Mod' => 'Expression\Modulus',
        'Expr_BinaryOp_Mul' => 'Expression\Multiplication',
        'Expr_BinaryOp_Pow' => 'Expression\Power',
        'Scalar_LNumber' => 'Scalar\Number',
        'Scalar_DNumber' => 'Scalar\Number',
        'Expr_Assign' => 'Expression\Assignment',
        'Expr_Variable' => 'Expression\Variable',
        'Expr_BinaryOp_Equal' => 'Expression\Equal',
        'Expr_BinaryOp_NotEqual' => 'Expression\NotEqual',
        'Expr_BinaryOp_Identical' => 'Expression\Identical',
        'Expr_BinaryOp_NotIdentical' => 'Expression\NotIdentical',
        'Expr_BinaryOp_LogicalAnd' => 'Expression\And',
        'Expr_BinaryOp_BooleanAnd' => 'Expression\And',
        'Expr_BinaryOp_LogicalOr' => 'Expression\Or',
        'Expr_BinaryOp_BooleanOr' => 'Expression\Or',
        'Expr_BinaryOp_LogicalXor' => 'Expression\Xor',
        'Expr_BooleanNot' => 'Expression\Negation',
        'Expr_BinaryOp_Greater' => 'Expression\Greater',
        'Expr_BinaryOp_GreaterOrEqual' => 'Expression\GreaterOrEqual',
        'Expr_BinaryOp_Smaller' => 'Expression\Smaller',
        'Expr_BinaryOp_SmallerOrEqual' => 'Expression\SmallerOrEqual',
        'Stmt_If' => 'Statement\If',
        'Stmt_ElseIf' => 'Statement\If',
        'Expr_ConstFetch' => 'Expression\Constant',
    ];

    /**
     * @param Node $node
     * @param $context
     * @return AbstractTranspiler
     * @throws NotImplementedException
     */
    public static function create(Node $node, $context)
    {
        if ($context === null) {
            throw new ContextNotProvidedException('You have to provide the context');
        }
        $type = $node->getType();
        if (!array_key_exists($type, self::$transpilersMap)) {
            throw new NotImplementedException("'" . $node->getType() . "' not implemented.");
        }
        $className = "\\Php2js\\Transpilers\\" . self::$transpilersMap[$type] . 'Transpiler';
        $transpiler = new $className($node);
        $transpiler->setContext($context);
        return $transpiler;
    }
}
