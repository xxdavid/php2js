<?php
namespace Php2js\Expression;

use Php2js\AbstractDispatcher;
use Php2js\Exceptions\NotImplementedException;
use PhpParser\Node;

class ExpressionDispatcher extends AbstractDispatcher
{
    /**
     * @return string
     */
    public function dispatch()
    {
        switch ($this->type) {
            case 'Concat':
                $transpiler = new ConcatTranspiler($this->node);
                break;
            default:
                $this->throwNotImplementedException();
                break;
        }
        return $transpiler->transpile();
    }
}
