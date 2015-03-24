<?php
namespace Php2js\Statement;

use Php2js\AbstractDispatcher;
use PhpParser\Node;

class StatementDispatcher extends AbstractDispatcher
{
    /**
     * @return string
     */
    public function dispatch()
    {
        switch ($this->type) {
            case 'Echo':
                $transpiler = new EchoTranspiler($this->node);
                break;
            default:
                $this->throwNotImplementedException();
                break;
        }
        return $transpiler->transpile();
    }
}
