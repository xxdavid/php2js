<?php
namespace Php2js\Statement;

use PhpParser\Node;

class StatementDispatcher
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
            case 'Echo':
                $transpiler = new EchoTranspiler($this->node);
                break;
            default:
                throw new NotImplementedException("'" . $this->node->getType() . "' not implemented.");
                break;
        }
        return $transpiler->transpile();
    }
}
