<?php

namespace sistema\nucleo;

use sistema\nucleo\suporte\EasyPDO;

class ControladorDB
{
    protected EasyPDO $conection;

    public function __construct() {
        $this->conection = new EasyPDO();
    }
}