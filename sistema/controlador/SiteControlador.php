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

    public function post($dado) :void
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

    public function dashboard(): void
    {
        echo $this->template->rendenrizar('dashboard.html',
        [
        
        ]);
    }

    public function cadastroMaq(): void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($dados)) {
            
            $dados['operacoes'] = (int)$dados['operacoes'];
            $dados['qtd'] = (int)$dados['qtd'];
            (new MaquinaModelo)->cadastrar($dados);
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

    public function cadastroLayout(): void
    {
        echo $this->template->rendenrizar('cadastrolayout.html',
        [
            'maquinas' => (new MaquinaModelo)->buscar()
        ]);
    }

    public function producao(): void
    {
        echo $this->template->rendenrizar('producao.html',
        [
        
        ]);
    }
}