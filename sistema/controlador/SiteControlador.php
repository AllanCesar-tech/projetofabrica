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
}