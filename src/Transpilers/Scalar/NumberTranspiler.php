<?php
namespace Php2js\Transpilers\Scalar;

use Php2js\Transpilers\AbstractTranspiler;

class NumberTranspiler extends AbstractTranspiler
{
    /**
     * @return string
     */
    public function transpile()
    {
        return (string) $this->node->value;
    }
}
