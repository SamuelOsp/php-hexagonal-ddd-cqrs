<?php

class GetUserByIdQuery
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}
