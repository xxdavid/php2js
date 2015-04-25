<?php
namespace Php2js\Transpilers\Expression;

class AndTranspiler extends AbstractLeftRightTranspiler
{
    /**
     * @return string
     */
    public function join($left, $right)
    {
        return "($left) && ($right)";
    }
}
