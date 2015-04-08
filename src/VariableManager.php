<?php
namespace Php2js;

class VariableManager
{
    /** @var array */
    private $declaredVariables = [];

    /**
     * @param string $variableName
     * @return bool
     */
    public function checkIfDeclared($variableName)
    {
        return in_array($variableName, $this->declaredVariables);
    }

    /**
     * @param string $variableName
     */
    public function addToDeclared($variableName)
    {
        $this->declaredVariables[] = $variableName;
    }
}
