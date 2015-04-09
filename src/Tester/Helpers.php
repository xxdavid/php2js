<?php
namespace Php2js\Tester;

class Helpers
{
    /**
     * @param string $filename
     * @return string
     */
    public static function stripExtension($filename)
    {
        return pathinfo($filename, PATHINFO_DIRNAME) . '/' . pathinfo($filename, PATHINFO_FILENAME);
    }

    /**
     * based on http://stackoverflow.com/a/4517270/2223873
     * @param string $string
     * @param string $prefix
     * @return string
     */
    public static function stripPrefix($string, $prefix)
    {
        if (substr($string, 0, strlen($prefix)) == $prefix) {
            return substr($string, strlen($prefix));
        } else {
            return $string;
        }
    }
}
