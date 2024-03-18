<?php

namespace sistema\modelo;

use sistema\nucleo\ControladorDB;

class MaquinaModelo extends ControladorDB
{
    /*public function buscarId(array $dados): array
    {
        
    }*/
    
    public function buscar(): array
    {
        $query = "SELECT * FROM maquina";
      return $this->conection->select($query);
    }
}