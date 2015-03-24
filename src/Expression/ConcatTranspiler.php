<?php
namespace Php2js\Expression;

use Php2js\NodeDispatcher;
use PhpParser\Node;

class ConcatTranspiler
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
     */
    public function transpile()
    {
        $expressions = array_map(function ($value) {
            $object = new NodeDispatcher($value);
            return $object->dispatch();
        }, [$this->node->left, $this->node->right]);
        return $expressions[0] . ' + ' . $expressions[1];
    }
}
