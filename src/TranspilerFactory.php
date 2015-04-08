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
