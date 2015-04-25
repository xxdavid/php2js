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
        'Expr_BinaryOp_Div' => 'Expression\Operators\Arithmetic\Division',
        'Expr_BinaryOp_Minus' => 'Expression\Operators\Arithmetic\Minus',
        'Expr_BinaryOp_Plus' => 'Expression\Operators\Arithmetic\Plus',
        'Expr_BinaryOp_Mod' => 'Expression\Operators\Arithmetic\Modulus',
        'Expr_BinaryOp_Mul' => 'Expression\Operators\Arithmetic\Multiplication',
        'Expr_BinaryOp_Pow' => 'Expression\Operators\Arithmetic\Power',
        'Scalar_LNumber' => 'Scalar\Number',
        'Scalar_DNumber' => 'Scalar\Number',
        'Expr_Assign' => 'Expression\Assignment',
        'Expr_Variable' => 'Expression\Variable',
        'Expr_BinaryOp_Equal' => 'Expression\Operators\Comparison\Equal',
        'Expr_BinaryOp_NotEqual' => 'Expression\Operators\Comparison\NotEqual',
        'Expr_BinaryOp_Identical' => 'Expression\Operators\Comparison\Identical',
        'Expr_BinaryOp_NotIdentical' => 'Expression\Operators\Comparison\NotIdentical',
        'Expr_BinaryOp_LogicalAnd' => 'Expression\Operators\Logical\And',
        'Expr_BinaryOp_BooleanAnd' => 'Expression\Operators\Logical\And',
        'Expr_BinaryOp_LogicalOr' => 'Expression\Operators\Logical\Or',
        'Expr_BinaryOp_BooleanOr' => 'Expression\Operators\Logical\Or',
        'Expr_BinaryOp_LogicalXor' => 'Expression\Operators\Logical\Xor',
        'Expr_BooleanNot' => 'Expression\Operators\Logical\Negation',
        'Expr_BinaryOp_Greater' => 'Expression\Operators\Comparison\Greater',
        'Expr_BinaryOp_GreaterOrEqual' => 'Expression\Operators\Comparison\GreaterOrEqual',
        'Expr_BinaryOp_Smaller' => 'Expression\Operators\Comparison\Smaller',
        'Expr_BinaryOp_SmallerOrEqual' => 'Expression\Operators\Comparison\SmallerOrEqual',
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
