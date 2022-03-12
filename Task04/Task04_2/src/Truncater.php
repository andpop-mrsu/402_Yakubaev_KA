<?php

namespace App;

class Truncater
{
    private static array $defaultOptions = array("separator" => "...", "length" => 100);
    private $options = array();

    public function __construct(array $options = null)
    {
        if (is_null($options)) {
            $this->options = self::$defaultOptions;
        } else {
            $this->options = $options + self::$defaultOptions;
        }
    }

    public function truncate(string $str, array $options = null): string
    {
        if (is_null($options)) {
            $options = $this->options;
        } else {
            $options = $options + $this->options;
        }

        if (strlen($str) <= $options["length"]) {
            return $str;
        }

        $newStr = substr($str, 0, $options["length"]) . $options["separator"];

        return $newStr;
    }
}
