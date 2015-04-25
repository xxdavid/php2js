<?php
namespace Php2js\Transpilers\Expression;

class PowerTranspiler extends AbstractLeftRightTranspiler
{
    /**
     * @return string
     */
    public function join($left, $right)
    {
        return "Math.pow($left, $right)";
    }
}
