<?php
namespace Php2js;

use Php2js\Exceptions\NotImplementedException;
use Php2js\Scalar\ScalarDispatcher;
use Php2js\Expression\ExpressionDispatcher;
use Php2js\Statement\StatementDispatcher;
use PhpParser\Node;

class NodeDispatcher
{
    /** @var  Node */
    private $node;

    /**
     * @param $node
     */
    public function __construct(Node $node)
    {
        $this->node = $node;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function dispatch()
    {
        $transpiler = TranspilerFactory::create($this->node);
        return $transpiler->transpile();
    }
}
