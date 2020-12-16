<?php
namespace App\config;

/**
 * Work with values on POST & GET data.
 */
class Parameter
{
    private $parameter;

    public function __construct($parameter)
    {
        $this->parameter = $parameter;
    }

    public function get($name)
    {
        if (isset($this->parameter[$name])) {
            return htmlspecialchars($this->parameter[$name]);
        }
    }

    public function set($name, $value)
    {
        $this->parameter[$name] = $value;
    }

    public function all()
    {
        return $this->parameter;
    }
}
