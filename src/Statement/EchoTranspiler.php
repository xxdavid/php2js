<?php
namespace Php2js\Statement;

use Php2js\NodeDispatcher;
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
        $expressions = $this->node->exprs;

        $expressions = array_map(function ($value) {
            $object = new NodeDispatcher($value);
            return $object->dispatch();
        }, $expressions);

        return 'console.log(' . implode(' + ', $expressions) . ');';
    }
}
