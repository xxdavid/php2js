<?php
namespace Php2js\Transpilers\Expression\Operators\Logical;

use Php2js\Transpilers\Expression\AbstractLeftRightTranspiler;

class XorTranspiler extends AbstractLeftRightTranspiler
{
    /**
     * @return string
     */
    public function join($left, $right)
    {
        return "($left && !($right)) || (!($left) && $right)";
    }
}
