<?php
namespace Php2js;

use PhpParser\Node;

abstract class AbstractScope extends Transpilers\AbstractTranspiler
{
    /** @var VariableManager */
    public $variableManager;

    /** @var array */
    protected $prependArray = [];

    public function __construct(Node $node)
    {
        parent::__construct($node);
        $this->setScope($this);
        $this->variableManager = new VariableManager();
    }

    public function prepend($stringToPrepend)
    {
        $this->prependArray[] = $stringToPrepend;
    }
}
