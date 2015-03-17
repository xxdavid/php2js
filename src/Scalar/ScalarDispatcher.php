<?php
namespace Php2js\Scalar;

use PhpParser\Node;

class ScalarDispatcher
{
    /** @var  Node */
    private $node;

    /** @var  string */
    private $type;

    /**
     * @param mixed $node
     */
    public function setNode(Node $node)
    {
        $this->node = $node;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function dispatch()
    {
        switch ($this->type) {
            case 'String':
                $object = new StringTranspiler($this->node);
                return $object->transpile();
            default:
                throw new \Exception('Not implemented: ' . $this->type);
                break;
        }
    }
}
