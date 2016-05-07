<?php

ini_set('display_errors', 1);

require __DIR__ . '/vendor/autoload.php';

$di = new Phalcon\Di\FactoryDefault();

$app = new Phalcon\Mvc\Micro($di);

$app->get('/', function(){

    $arquivo = new \Api\CartaoCreditoEmArquivo();
    $cartaoCredito = $arquivo->recuperar();

    $cartaoCredito->descriptografar();

    $resposta = (new \Api\Resposta())
        ->setConteudo($cartaoCredito->toArray());

    echo $resposta;
});

$app->post('/', function(){
    $content = json_decode(file_get_contents('php://input'));

    $cartaoCredito = new \Api\CartaoCredito($content);
    $cartaoCredito->encriptografar();

    $arquivo = new \Api\CartaoCreditoEmArquivo();
    $arquivo->salvar($cartaoCredito);

    $resposta = (new \Api\Resposta())
        ->setCodigo(201)
        ->setConteudo('Dados criado com sucesso!');

    echo $resposta;
});

$app->notFound(function(){
    die('ops');
});

$app->handle();
