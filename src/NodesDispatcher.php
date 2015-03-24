<?php
namespace Php2js;

use PhpParser\Node;

class NodesDispatcher
{
    /** @var  Node[] */
    private $nodes;

    /**
     * @param Node[] $nodes
     */
    public function __construct(array $nodes)
    {
        $this->nodes = $nodes;
    }

    public function dispatch()
    {
        return array_map(function ($node) {
            $dispatcher = new NodeDispatcher($node);
            return $dispatcher->dispatch();
        }, $this->nodes);
    }
}
