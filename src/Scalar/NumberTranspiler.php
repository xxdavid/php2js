<?php
namespace Php2js\Scalar;

use Php2js\AbstractTranspiler;

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
