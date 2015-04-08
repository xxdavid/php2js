<?php
namespace Php2js\Statement;

use Php2js\AbstractTranspiler;
use Php2js\NodeDispatcher;
use Php2js\NodesDispatcher;
use PhpParser\Node;

class EchoTranspiler extends AbstractTranspiler
{
    /**
     * @return string
     */
    public function transpile()
    {
        $dispatcher = new NodesDispatcher($this->node->exprs);
        $expressions = $dispatcher->dispatch();


        return 'console.log(' . implode(' + ', $expressions) . ');';
    }
}
