<?php

/*
 * This file is part of the design-pattern.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace DesignPattern\Behavioral\Mediator;


use DesignPattern\Behavioral\Mediator\Subsystem\Client;
use DesignPattern\Behavioral\Mediator\Subsystem\Database;
use DesignPattern\Behavioral\Mediator\Subsystem\Server;

class Mediator implements MediatorInterface
{

    private $server;

    private $database;

    private $client;

    public function __construct(Database $database, Client $client, Server $server)
    {
        $this->database = $database;
        $this->database->setMediator($this);
        $this->client = $client;
        $this->client->setMediator($this);
        $this->server = $server;
        $this->server->setMediator($this);
    }

    public function sendResponse(string $content)
    {
        $this->client->output($content);
    }

    public function makeRequest()
    {
        $this->server->process();
    }

    public function queryDb()
    {
        return $this->database->getData();
    }
}