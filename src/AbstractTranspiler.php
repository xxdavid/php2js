<?php
namespace Php2js;

use PhpParser\Node;

abstract class AbstractTranspiler
{
    protected $node;

    /**
     * @param Node $node
     */
    public function __construct(Node $node)
    {
        $this->node = $node;
    }
}
