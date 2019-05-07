<?php
require dirname(__DIR__) . '/QuickSocket/vendor/autoload.php';

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

class Server implements MessageComponentInterface {
    protected $clients;
    public $users = [];

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        if(!in_array($from, $this->users)) {
            array_push($this->users, $from);
        }
        $data = json_decode($msg);
        echo $from->remoteAddress." ".$data->{"file"}." main->server \n";
        include $data->{"file"};

        $variables = [];
        if(isset($data->{"var"}) && $data->{"var"} != null) {
            foreach($data->{"var"} as $key => $value) {
                $variables[$key] = $value;
            }
        }

        $main->Server($variables, $from, $this->users);
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        $conn->close();
    }
}

function ErrorHandler($level, $message, $file, $line) {
    echo("An error has occured: $message. File: $file. Line: $line. \n");
}


$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Server()
        )
    ),
    8080
);

set_error_handler("ErrorHandler");

$server->run();
?>