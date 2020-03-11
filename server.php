<?php

require __DIR__ . "/vendor/autoload.php";

$argument_options = getopt(null, ["host:", "port:"]);

$host = isset($argument_options["host"]) ?
    $argument_options["host"] :
    "127.0.0.1";

$port = isset($argument_options["port"]) ?
    $argument_options["port"] :
    "9100";

$loop = React\EventLoop\Factory::create();
$socket = new React\Socket\Server("{$host}:{$port}", $loop);

print("Dummy printer server currently listening on {$host}:{$port}\n");

$socket->on('connection', function (React\Socket\ConnectionInterface $connection) {
    print("Receiving connection from " . $connection->getRemoteAddress() . "\n");

    $connection->on('data', function ($data) use ($connection) {
        print($data . "\n");
    });
});

$loop->run();