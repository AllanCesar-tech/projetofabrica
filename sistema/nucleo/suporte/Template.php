<?php

namespace sistema\nucleo\suporte;

use Twig\TwigFunction;

class Template 
{
    private \Twig\Environment $twig;

    public function __construct(string $diretorio) 
    {
        $loader = new \Twig\Loader\FilesystemLoader($diretorio);
        
        $this->twig = new \Twig\Environment($loader);
    }

    public function rendenrizar(string $view, array $dados)
    {
        return $this->twig->render($view,$dados);
    }
}