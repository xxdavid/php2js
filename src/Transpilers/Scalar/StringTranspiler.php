<?php
namespace Php2js\Transpilers\Scalar;

use Php2js\Transpilers\AbstractTranspiler;
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
