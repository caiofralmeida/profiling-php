<?php

namespace Api;

use Phalcon\Crypt;

class CartaoCredito
{
    private $numero;
    private $titular;
    private $validade;
    private $cvv;

    private $crypt;

    private $key = 'j4m4lbl4ckf1r3';

    public function __construct($data)
    {
        foreach($data as $field => $value) {
            $this->{$field} = $value;
        }

        $this->crypt = new Crypt();
    }

    public function encriptografar()
    {
        $this->numero   = $this->encriptografarCampo($this->numero);
        $this->validade = $this->encriptografarCampo($this->validade);
        $this->titular  = $this->encriptografarCampo($this->titular);
        $this->cvv      = $this->encriptografarCampo($this->cvv);
    }

    private function encriptografarCampo($campo)
    {
        return base64_encode($this->crypt->encrypt($campo, $this->key));
    }

    public function toJson()
    {
        return json_encode([
            'numero'  => $this->numero,
            'titular' => $this->titular,
            'validade' => $this->validade,
            'cvv' => $this->cvv
        ]);
    }
}
