<?php
namespace Php2js\Expression;

use Php2js\Exceptions\NotImplementedException;
use PhpParser\Node;

class ExpressionDispatcher
{
    /** @var  Node */
    private $node;

    /** @var  string */
    private $type;

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @param Node $node
     */
    public function setNode($node)
    {
        $this->node = $node;
    }

    /**
     * @return string
     */
    public function dispatch()
    {
        switch ($this->type) {
            case 'Concat':
                $transpiler = new ConcatTranspiler($this->node);
                break;
            default:
                throw new NotImplementedException("'" . $this->node->getType() . "' not implemented.");
                break;
        }
        return $transpiler->transpile();
    }
}
