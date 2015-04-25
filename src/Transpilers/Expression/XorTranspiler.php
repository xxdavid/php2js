<?php
namespace Php2js\Transpilers\Expression;

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
