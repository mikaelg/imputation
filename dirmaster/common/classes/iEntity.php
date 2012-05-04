<?php namespace Common;

interface iEntity
{
    public function Create($_address_data);
    public function Update($_address_data);
    public function Delete();
}

?>