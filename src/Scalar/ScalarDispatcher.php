<?php
namespace Php2js\Scalar;

use Php2js\AbstractDispatcher;
use PhpParser\Node;

class ScalarDispatcher extends AbstractDispatcher
{
    /**
     * @return string
     */
    public function dispatch()
    {
        switch ($this->type) {
            case 'String':
                $transpiler = new StringTranspiler($this->node);
                break;
            case 'LNumber':
                $transpiler = new NumberTranspiler($this->node);
                break;
            case 'DNumber':
                $transpiler = new NumberTranspiler($this->node);
                break;
            default:
                $this->throwNotImplementedException();
                break;
        }
        return $transpiler->transpile();
    }
}
