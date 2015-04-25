<?php
namespace Php2js\Transpilers\Expression;

class NotIdenticalTranspiler extends AbstractLeftRightTranspiler
{
    /**
     * @return string
     */
    public function join($left, $right)
    {
        return "$left !== $right";
    }
}
