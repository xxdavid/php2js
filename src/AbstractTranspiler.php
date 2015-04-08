<?php
namespace Php2js;

use PhpParser\Node;

abstract class AbstractTranspiler
{
    protected $node;

    protected $configuration;

    /**
     * @param Node $node
     */
    public function __construct(Node $node)
    {
        $this->node = $node;
    }

    /**
     * @param $context
     */
    public function setContext($context)
    {
        $this->configuration = $context->configuration;
    }
}
