<?php

ini_set('display_errors', 1);

require __DIR__ . '/vendor/autoload.php';

$di = new Phalcon\Di\FactoryDefault();

$app = new Phalcon\Mvc\Micro($di);

$app->get('/', function(){
    echo 'jamal';
});

$app->post('/', function(){
    $content = json_decode(file_get_contents('php://input'));

    $cartaoCredito = new \Api\CartaoCredito($content);
    $cartaoCredito->encriptografar();

    $arquivo = new \Api\CartaoCreditoEmArquivo();
    $arquivo->salvar($cartaoCredito);
});

$app->notFound(function(){
    die('ops');
});

$app->handle();
