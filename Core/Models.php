<?php

namespace Core;

abstract class Models
{
    public int $id;

    public function __construct(array $data_row = [])
    {
        foreach ($data_row as $colunm => $value) {
            if (!property_exists($this, $colunm))
                continue;
            $this->$colunm = $value;
        }
    }
}