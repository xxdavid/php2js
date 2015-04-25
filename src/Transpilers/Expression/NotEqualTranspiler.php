<?php
namespace Php2js\Transpilers\Expression;

class NotEqualTranspiler extends AbstractLeftRightTranspiler
{
    /**
     * @return string
     */
    public function join($left, $right)
    {
        return "$left != $right";
    }
}
