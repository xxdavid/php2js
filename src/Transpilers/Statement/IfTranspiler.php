<?php
namespace Php2js\Transpilers\Statement;

use Php2js\NodeDispatcher;
use Php2js\NodesDispatcher;
use Php2js\Transpilers\AbstractTranspiler;

class IfTranspiler extends AbstractTranspiler
{
    /**
     * @return string
     */
    public function transpile()
    {
        $conditionDispatcher = new NodeDispatcher($this->node->cond);
        $conditionDispatcher->setContext($this);
        $condition = $conditionDispatcher->dispatch();

        $thenDispatcher = new NodesDispatcher($this->node->stmts);
        $thenDispatcher->setContext($this);
        $thenStatements = $thenDispatcher->dispatch();

        if ($this->node->elseifs) {
            $elseIfDispatcher = new NodesDispatcher($this->node->elseifs);
            $elseIfDispatcher->setContext($this);
            $elseIfs = $elseIfDispatcher->dispatch();
        }

        if ($this->node->else) {
            $elseDispatcher = new NodesDispatcher($this->node->else->stmts);
            $elseDispatcher->setContext($this);
            $elseStatements = $elseDispatcher->dispatch();
        }

        $result = "if ($condition) {\n";
        $result .= $this->indentationManager->indent($thenStatements) . "\n";
        $result .= '}';

        if (isset($elseIfs)) {
            foreach ($elseIfs as $elseIf) {
                $result .= " else ";
                $result .= $elseIf;
            }
        }

        if (isset($elseStatements)) {
            $result .= " else {\n";
            $result .= $this->indentationManager->indent($elseStatements) . "\n";
            $result .= '}';
        }
        return $result;
    }
}
