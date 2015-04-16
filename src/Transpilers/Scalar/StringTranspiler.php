<?php
namespace Php2js\Transpilers\Scalar;

use Php2js\Transpilers\AbstractTranspiler;

class StringTranspiler extends AbstractTranspiler
{
    /**
     * @return string
     * @TODO: escape
     */
    public function transpile()
    {
        $quotes = $this->configuration->doubleQuotes ? '"' : "'";
        return $quotes . $this->node->value . $quotes;
    }
}
