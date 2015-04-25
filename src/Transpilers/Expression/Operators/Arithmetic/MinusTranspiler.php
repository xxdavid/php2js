<?php
namespace Php2js\Transpilers\Expression\Operators\Arithmetic;

use Php2js\Transpilers\Expression\AbstractLeftRightTranspiler;

class MinusTranspiler extends AbstractLeftRightTranspiler
{
    /**
     * @return string
     */
    public function join($left, $right)
    {
        return "$left - $right";
    }
}
