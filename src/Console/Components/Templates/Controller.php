<?php

namespace Solital\Components\Controller;

use Solital\Core\Course\Container\Container;
use Solital\Core\Resource\Message;

abstract class Controller
{
    /**
     * @var Message
     */
    protected Message $message;
    
    /**
     * @var Container
     */
    protected Container $container;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->message = new Message();
        $this->container = new Container();
    }
}
