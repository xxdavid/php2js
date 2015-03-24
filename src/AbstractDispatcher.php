<?php
namespace Php2js;

use Php2js\Exceptions\NotImplementedException;
use PhpParser\Node;

abstract class AbstractDispatcher
{
    /** @var  Node */
    protected $node;

    /** @var  string */
    protected $type;

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
    abstract public function dispatch();

    /**
     * @throws NotImplementedException
     */
    protected function throwNotImplementedException()
    {
        throw new NotImplementedException("'" . $this->node->getType() . "' not implemented.");
    }
}
