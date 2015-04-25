<?php
namespace Php2js\Transpilers;

use Php2js\Configuration;
use Php2js\IndentationManager;
use Php2js\VariableManager;
use PhpParser\Node;

abstract class AbstractTranspiler
{
    protected $node;

    /** @var Configuration */
    protected $configuration;

    protected $scope;

    /** @var VariableManager */
    protected $variableManager;

    /** @var IndentationManager */
    protected $indentationManager;

    /**
     * @param Node $node
     */
    public function __construct(Node $node)
    {
        $this->node = $node;
    }

    /**
     * @param AbstractTranspiler $context
     */
    public function setContext(AbstractTranspiler $context)
    {
        $this->setConfiguration($context->configuration);
        $this->setScope($context->scope);
        $this->indentationManager = $context->indentationManager;
    }

    public function setConfiguration($configuration)
    {
        $this->configuration = $configuration;
    }

    protected function setScope($scope)
    {
        $this->scope = $scope;
    }
}
