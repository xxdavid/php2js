<?php
namespace Php2js;

class IndentationManager
{
    /** @var string */
    private $indentationString;

    /**
     * @param Configuration $configuration
     */
    public function __construct($configuration)
    {
        switch ($configuration->indentationStyle) {
            case 'tab':
                $this->indentationString = "\t";
                break;
            default:
                $matches = [];
                preg_match('#(\d{1,2}) spaces?#', $configuration->indentationStyle, $matches);
                if ($matches) {
                    $this->indentationString = str_repeat(' ', $matches[1]);
                } else {
                    throw new \InvalidArgumentException("Indentation style you have set ('$configuration->indentationStyle') is not valid. Possible values are: 'tab', '1 space' or 'x spaces' where x is an integer");
                }
        }
    }

    /**
     * @param array|string $input
     * @return string
     */
    public function indent($input)
    {
        if (is_array($input)) {
            $lines = [];
            foreach ($input as $statement) {
                $statementLines = explode("\n", $statement);
                $lines = array_merge($lines, $statementLines);
            }
        } else {
            $lines = explode("\n", $input);
        }
        $indentedLines = array_map(function ($value) {
            return $this->indentationString  . $value;
        }, $lines);
        return implode("\n", $indentedLines);
    }
}
