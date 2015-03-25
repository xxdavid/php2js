<?php
namespace Php2js;

use PhpParser\Node;

class NodesDispatcher
{
    /** @var  Node[] */
    private $nodes;

    /** @var  callable */
    private $postHooks = [];

    /**
     * @param Node[] $nodes
     */
    public function __construct(array $nodes)
    {
        $this->nodes = $nodes;
    }

    /**
     * @return array
     * @throws Exceptions\NotImplementedException
     */
    public function dispatch()
    {
        $transpiledNodes = [];
        foreach ($this->nodes as $node) {
            $dispatcher = new NodeDispatcher($node);
            $result = $dispatcher->dispatch();
            foreach ($this->postHooks as $hook) {
                $result = $hook($node, $result);
            }
            $transpiledNodes[] = $result;
        }
        return $transpiledNodes;
    }

    /**
     * @param callable $function
     */
    public function addPostTranspilationHook($function)
    {
        $this->postHooks[] = $function;
    }
}
