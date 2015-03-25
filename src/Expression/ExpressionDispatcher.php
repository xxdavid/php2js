<?php
namespace Php2js\Expression;

use Php2js\AbstractDispatcher;
use PhpParser\Node;

class ExpressionDispatcher extends AbstractDispatcher
{
    /**
     * @return string
     */
    public function dispatch()
    {
        switch ($this->type) {
            case 'BinaryOp_Concat':
                $transpiler = new ConcatTranspiler($this->node);
                break;
           case 'BinaryOp_Plus':
                $transpiler = new PlusTranspiler($this->node);
                break;
            case 'BinaryOp_Minus':
                $transpiler = new MinusTranspiler($this->node);
                break;
            case 'BinaryOp_Mul':
                $transpiler = new MultiplicationTranspiler($this->node);
                break;
            case 'BinaryOp_Div':
                $transpiler = new DivisionTranspiler($this->node);
                break;
             case 'BinaryOp_Mod':
                $transpiler = new ModulusTranspiler($this->node);
                break;
            case 'BinaryOp_Pow':
                $transpiler = new PowerTranspiler($this->node);
                break;
            default:
                $this->throwNotImplementedException();
                break;
        }
        return $transpiler->transpile();
    }
}
