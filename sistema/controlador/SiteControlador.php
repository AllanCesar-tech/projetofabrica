<?php

namespace sistema\controlador;

use sistema\modelo\MaquinaModelo;
use sistema\nucleo\Controlador;
use sistema\nucleo\Helpers;

class SiteControlador extends Controlador
{
    public function __construct() {
        parent::__construct('templates/site/views');
    }

    public function erro404() :void
    {
        echo $this->template->rendenrizar('404.html',[]);
    }
    
    public function index() :void
    {
        echo $this->template->rendenrizar('index.html',[]);
    }

    public function sobre() :void
    {
        echo $this->template->rendenrizar('sobre.html',
        [
            'dados' => (new MaquinaModelo())->buscar()
        ]);
    }

    public function post($dado = null) :void
    {
         $modelo = (new MaquinaModelo())->filtrar($dado);
        
         if(!$modelo) {
             Helpers::redirecionar('404');
         }
        echo $this->template->rendenrizar('post.html',
        [
            'modelo' => (new MaquinaModelo())->filtrar($dado)
        ]);
    }

    public function dashboard(string $layout): void
    {
         var_dump((new MaquinaModelo)->buscarProducao($layout));
        echo $this->template->rendenrizar('dashboard.html',
        [
            'producao' => (new MaquinaModelo)->buscarProducao($layout)
        ]);
    }

    public function cadastroMaq(): void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($dados)) {
            
            (new MaquinaModelo)->cadastrarMaquina($dados);
            // Para validações posteriormente
            // foreach ($dados as $key => $value) 
            //{
            //     if ($value == null) 
            //     {
            //         if ($key != 'operacoes' && $key != 'valor') {
            //             die('Campos Obrigatórios em branco');
            //         } else {die ('enviado com sucesso');}
            //     } 
           // }
        }                
         echo $this->template->rendenrizar('cadastromaquina.html',
         [
        
         ]);
    }

    public function montarLayout($id): void
    {   
         $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
         if (!empty($dados)) {
            var_dump((new MaquinaModelo)->montarLayout($dados));
        }
          
        echo $this->template->rendenrizar('cadastrolayout.html',
        [
            'maquinas' => (new MaquinaModelo)->buscar(),
            'layouts' => (new MaquinaModelo)->filtrarLayout($id)
        ]);
    }

    public function producao($layout): void
    {             
        // $maquinas = (new MaquinaModelo)->BuscarMaqTabela($layout);
        // if(!$maquinas) {
        //     Helpers::redirecionar('404');
        // }
        
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $dados['data'] ="'" .DATA_ATUAL."'";
        if (!empty($dados)) {
           (new MaquinaModelo)->guardarProducao($layout, $dados);
           
        }
        array_pop($maquinas);

        echo $this->template->rendenrizar('producao.html',
        [
            'maquinas' => $maquinas,
            'DATA_ATUAL' => DATA_ATUAL
        ]);
    }

    public function layouts(): void
    {
        $dados = filter_input_array(INPUT_POST,FILTER_DEFAULT);
        if (!empty($dados)) {
            (new MaquinaModelo)->cadastrarLayout($dados);
        }

        echo $this->template->rendenrizar('layouts.html',
        [
            'layouts' => (new MaquinaModelo)->listarLayout(),
            'URL_DEV' => URL_DEV
        ]);
    }

    public function deletar($id): void
    {
        //$id = filter_input(INPUT_POST, FILTER_DEFAULT);

        if (!empty($id)) {
            (new MaquinaModelo)->deletar($id);
        }

        Helpers::redirecionar('layouts');
    }
}