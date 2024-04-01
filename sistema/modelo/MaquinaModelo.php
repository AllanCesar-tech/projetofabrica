<?php

namespace sistema\modelo;

use sistema\nucleo\ControladorDB;

class MaquinaModelo extends ControladorDB
{
    public function filtrar(string $dado) :array|bool
    {
        $query = "SELECT * FROM maquina WHERE modelo = '{$dado}'";
       return $this->conection->select($query);
    }
    
    public function buscar(): array
    {
        //podemos organizar o array de acordo com parâmetros ORDERY BY que passamso na query
        $query = "SELECT * FROM maquina ORDER BY modelo ASC"; 
      return $this->conection->select($query);
    }

    public function cadastrar(array $dados): void
    {
      $query = "INSERT INTO maquina (modelo, marca, funcao, operacoes_peca, valor_compra, qtd_existente) VALUES (:modelo, :marca, :funcao, :operacoes, :valor, :qtd)"; // testar se funciona sem as aspas em values

      $this->conection->insert($query, $dados);
    }
}