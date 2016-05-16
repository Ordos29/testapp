<?php

/**
 * Created by PhpStorm.
 * User: anton
 * Date: 14.05.16
 * Time: 17:32
 */
class Basictypes_String implements Adaptor_DataType
{
    protected $value;

    public function __construct($value)
    {
        $this->value = (string)$value;
    }

    public function getValue($mode = Adaptor_DataType::INT)
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = (string)$value;

        return $this->value;
    }

    public function __toString()
    {
        return $this->value;
    }

    public function LogicalToXSD()
    {
        return $this->value;
    }

    public function LogicalToSQL()
    {
        return $this->value;
    }
}
