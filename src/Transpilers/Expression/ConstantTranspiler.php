<?php
namespace Php2js\Transpilers\Expression;

use Php2js\Exceptions\NotImplementedException;
use Php2js\Transpilers\AbstractTranspiler;

class ConstantTranspiler extends AbstractTranspiler
{
    /**
     * @return string
     */
    public function transpile()
    {
        switch ($this->node->name->parts[0]) {
            case 'true': return 'true';
            case 'false': return 'false';
            default:
                throw new NotImplementedException($this->node->name->parts[0] . ' not implemented');
        }
    }
}
