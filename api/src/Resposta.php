<?php

namespace Api;

class Resposta
{
    private $codigo = 200;
    private $conteudo = 'OK';

    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
        return $this;
    }

    public function setConteudo($conteudo)
    {
        $this->conteudo = $conteudo;
        return $this;
    }

    public function __toString()
    {
        http_response_code($this->codigo);
        header('Content-Type: application/json');

        return json_encode([
            'status'  => $this->codigo,
            'content' => $this->conteudo
        ]);
    }
}
