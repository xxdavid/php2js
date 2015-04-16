<?php
namespace Php2js\Transpilers\Statement;

use Php2js\Transpilers\AbstractTranspiler;
use Php2js\NodesDispatcher;

class EchoTranspiler extends AbstractTranspiler
{
    /**
     * @return string
     */
    public function transpile()
    {
        $dispatcher = new NodesDispatcher($this->node->exprs);
        $dispatcher->setContext($this);
        $expressions = $dispatcher->dispatch();

        return 'console.log(' . implode(' + ', $expressions) . ');';
    }
}
