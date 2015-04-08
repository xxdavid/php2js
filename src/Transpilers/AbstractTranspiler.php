<?php
namespace Php2js\Transpilers;

use Php2js\VariableManager;
use PhpParser\Node;

abstract class AbstractTranspiler
{
    protected $node;

    protected $configuration;

    protected $scope;

    /** @var VariableManager */
    protected $variableManager;

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
        $this->setConfiguration($context->configuration);
        $this->setScope($context->scope);
        $this->setVariableManager($context->variableManager);
    }

    public function setConfiguration($configuration)
    {
        $this->configuration = $configuration;
    }

    private function setScope($scope)
    {
        $this->scope = $scope;
    }

    /**
     * @param VariableManager $variableManager
     */
    public function setVariableManager($variableManager)
    {
        $this->variableManager = $variableManager;
    }
}
