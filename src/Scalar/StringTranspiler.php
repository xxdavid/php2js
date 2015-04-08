<?php
namespace Php2js\Scalar;

use Php2js\AbstractTranspiler;
use PhpParser\Node;

class StringTranspiler extends AbstractTranspiler
{
    /**
     * @return string
     * @TODO: escape
     */
    public function transpile()
    {
        return '"' . $this->node->value . '"';
    }
}
