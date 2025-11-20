<?php

class Usuario {

  function __construct(private $nombre, private $clave, private $accesos)
  {
  
  }

function __get($name ){
    if ( property_exists($this,$name)){
        return $this->$name;
    }
}

function __set($name, $value)
{
    if ( property_exists($this,$name)){
        $this->$name = $value;
    }

}

}