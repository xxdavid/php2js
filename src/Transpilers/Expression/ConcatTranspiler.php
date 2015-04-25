<?php
namespace Php2js\Transpilers\Expression;

class ConcatTranspiler extends AbstractLeftRightTranspiler
{
    /**
     * @return string
     */
    public function join($left, $right)
    {
        return "$left + $right";
    }
}
