<?php

namespace sistema\controlador;
use sistema\nucleo\Controlador;

class SiteControlador extends Controlador
{
    public function __construct() {
        parent::__construct('templates/site/views');
    }
    
    public function index() :void
    {
        echo $this->template->rendenrizar('index.html',[]);
    }
}