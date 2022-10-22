<?php

use Swoole\WebSocket\Server;
use Swoole\Http\Request;
use Swoole\WebSocket\Frame;
use Swoole\Http\Response;

const EVENTO_WS_SERVIDOR_INICIALIZADO = 'Start';
const EVENTO_WS_CONEXAO_ABERTA = 'Open';
const EVENTO_WS_CONEXAO_FECHADA = 'Close';
const EVENTO_WS_MENSAGEM_RECEBIDA = 'Message';
const EVENTO_WS_REQUISICAO_HTTP = 'Request';

function informarInicializacaoServidor(Server $server) {
    echo 'Servidor Web Socket Swoole inicializado em: http://127.0.0.1:9502' . PHP_EOL;
}

function tratarNovoConexao(Server $server, Request $request) {
    echo "connection open: {$request->fd}" . PHP_EOL;

//    $server->tick(100, function() use ($server, $request) {
//        $server->push($request->fd, json_encode(["hello", time()]));
//    });
}

function enviarMensagemParaDestinatario(Server $server, Frame $frame) {
    var_dump($frame->data);
    $server->push($frame->fd, json_encode(["hello", time()]));
}

function tratarRequisicaoHttp(Request $request, Response $response, Server $server) {
    foreach($server->connections as $fd) {
        if (!$server->isEstablished($fd)) {
            continue;
        }

        $server->push($fd, $request->get['message']);
    }
}

function finalizarConexao(Server $server, int $fd) {
    echo "connection close: {$fd}\n";
}