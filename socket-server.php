<?php

use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use App\Libraries\Notify;

require __DIR__ . '/vendor/autoload.php';

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Notify()
        )
    ),
    8080 
);

echo "Servidor WebSocket iniciado en puerto 8080\n";

$server->run();
