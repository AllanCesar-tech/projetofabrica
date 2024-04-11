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
    
    public function buscarMaq(): array
    {
        //podemos organizar o array de acordo com parâmetros ORDERY BY que passamso na query
        $query = "SELECT * FROM machine ORDER BY model ASC"; 
      return $this->conection->select($query);
    }

    public function cadastrarMaquina(array $dados): void
    {
      $query = "INSERT INTO machine (model, brand, designation, piece_operations, purchase_price, quantity) VALUES (:modelo, :marca, :funcao, :operacoes, :valor, :qtd)"; // testar se funciona sem as aspas em values

      $this->conection->insert($query, $dados);
    }

    public function cadastrarLayout(array $dados): void
    {
      $query = "INSERT INTO layout (denomination, observation) 
      VALUES (:nome,:descricao)";

      $this->conection->insert($query,$dados);
    }

    public function montarLayout(string $id, array $dados)
    {
      unset($dados['layout']); // fazer formulario parar de enviar, colocar condicional
      $querys = [];
      //$i= 1;
    foreach ($dados as $chave => $valor) {
      $query = "INSERT INTO layout_machine (fk_id_layout, fk_id_machine) VALUES ";
      $querys[] = $query .= "($id, $valor)";
      //$i++;
    } 
    //return $querys;
    // $dados = [
    //   'query1' => "INSERT INTO `layout_machine` (fk_id_layout, fk_id_machine) VALUES ('1','2')",
    //   'query2' => "INSERT INTO `layout_machine` (fk_id_layout, fk_id_machine) VALUES ('1','3')"
    // ];
    $this->conection->insertMult($querys);
  }

    public function listarLayout(): array
    {
      $query = "SELECT * FROM layout";

      return $this->conection->select($query);
    }

    public function filtrarLayout(string $id): array
    {
      $query = "SELECT * FROM layout WHERE id_layout = $id";

      return $this->conection->select($query);
    }

   
    public function guardarProducao(string $layout, array $dadosLayout): void
     { 
      $query = "INSERT INTO fabrica.$layout (";

      foreach($dadosLayout as $maquina => $producaoDoDia) {
        $query .= $maquina. ", ";
      }

      $query = rtrim($query, ", "). ")";
      $query .= " VALUES (";

      foreach($dadosLayout as $producaoDoDia) {
        $query .=$producaoDoDia.", ";
      }

      $query = rtrim($query, ", "). ")";

      //return $query;
      $this->conection->insert($query);
      
    }

    public function buscarProducao(string $layout)
    {
      $hoje ="'". DATA_ATUAL ."'";
      $query = "SELECT * FROM fabrica.$layout WHERE data = '2024-04-02'";
      $res = $this->conection->select($query);
      unset($res[0]['data']);
      $res = json_encode($res);
      return $res;
      
      
    }

    public function deletar(string $id): void
    {
      $query = "DELETE FROM layout WHERE id_layout = $id";
      $this->conection->delete($query);
    }
}