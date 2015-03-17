<?php
namespace Php2js\Scalar;

use PhpParser\Node;

class StringTranspiler
{
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
     * @TODO: escape
     */
    public function transpile()
    {
        return '"' . $this->node->value . '"';
    }
}
