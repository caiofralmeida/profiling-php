<?php

namespace Api;

class CartaoCreditoEmArquivo
{
    private $resource;
    private $caminho = 'resources/cc.txt';

    const LEITURA = 'r';
    const ESCRITA = 'w';

    public function salvar(CartaoCredito $cartaoCredito)
    {
        $this->abrirArquivoEmModo(self::ESCRITA);
        fwrite($this->resource, $cartaoCredito->toJson());
        $this->fecharArquivo();
    }

    public function recuperar()
    {
        $this->abrirArquivoEmModo(self::LEITURA);
        $data = fread($this->resource, $this->getTamanho());
        $this->fecharArquivo();

        return new CartaoCredito(json_decode($data));
    }

    private function abrirArquivoEmModo($modo)
    {
        $this->resource = fopen($this->caminho, $modo);
    }

    private function fecharArquivo()
    {
        fclose($this->resource);
    }

    public function getTamanho()
    {
        return filesize($this->caminho);
    }
}
