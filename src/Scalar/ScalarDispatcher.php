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
                return $transpiler->transpile();
            default:
                $this->throwNotImplementedException();
                break;
        }
    }
}
