<?php
namespace Php2js\Statement;

use Php2js\NodeDispatcher;
use Php2js\NodesDispatcher;
use PhpParser\Node;

class EchoTranspiler
{
    /** @var Node */
    private $node;

    /**
     * @param Node $node
     */
    public function __construct(Node $node)
    {
        $this->node = $node;
    }

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
