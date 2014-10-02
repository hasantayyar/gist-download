<?php

namespace Hasantayyar\GistDownload;

use GuzzleHttp\Event\ErrorEvent;
use GuzzleHttp\Client;

/**
 * @author Hasan Tayyar BEŞİK <tayyar.besik@gmail.com>
 * @package Gist Download
 */
class ApiClient {

    public $client;

    public function __construct() {
        $this->client = new Client(array('defaults' => array('allow_redirects' => false)));
        $emitter = $this->client->getEmitter();
        $emitter->on('error', function (ErrorEvent $event) {
            $event->stopPropagation();
        });
    }

}
