<?php
namespace Php2js\Transpilers\Scalar;

use Php2js\Transpilers\AbstractTranspiler;

class StringTranspiler extends AbstractTranspiler
{
    /**
     * @return string
     */
    public function transpile()
    {
        $quotes = $this->configuration->doubleQuotes ? '"' : "'";
        $value = $this->node->value;
        $value = str_replace('\\', '\\\\', $value);
        $value = str_replace("\t", '\t', $value);
        $value = str_replace("\n", '\n', $value);
        $value = str_replace("\r", '\r', $value);
        if ($this->configuration->doubleQuotes) {
            $value = str_replace('"', '\"', $value);
        } else {
            $value = str_replace("'", "\\'", $value);
        }
        return $quotes . $value . $quotes;
    }
}
