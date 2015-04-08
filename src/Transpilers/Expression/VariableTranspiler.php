<?php
namespace Php2js\Transpilers\Expression;

use Php2js\Transpilers\AbstractTranspiler;

class VariableTranspiler extends AbstractTranspiler
{
    /**
     * @return string
     */
    public function transpile()
    {
        $variableName = $this->node->name;
        if (!$this->variableManager->checkIfDeclared($variableName)) {
            $this->scope->prepend("var $variableName;");
            $this->variableManager->addToDeclared($variableName);
        }
        return $variableName;
    }
}
