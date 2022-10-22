<?php

require __DIR__.'/vendor/autoload.php';

use Swoole\WebSocket\Server;
use Swoole\Http\Request;
use Swoole\Http\Response;

$servidor = new Swoole\WebSocket\Server("0.0.0.0", 9502);
$servidor->on(EVENTO_WS_SERVIDOR_INICIALIZADO, informarInicializacaoServidor(...));
$servidor->on(EVENTO_WS_CONEXAO_ABERTA, tratarNovoConexao(...));
$servidor->on(EVENTO_WS_MENSAGEM_RECEBIDA, enviarMensagemParaDestinatario(...));
$servidor->on(EVENTO_WS_REQUISICAO_HTTP, fn (Request $request, Response $response) => tratarRequisicaoHttp($request, $response, $servidor));
$servidor->on(EVENTO_WS_CONEXAO_FECHADA, finalizarConexao(...));
$servidor->start();
