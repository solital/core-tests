<?php

namespace Solital\Core\Exceptions;

use ModernPHPException\ModernPHPException;
use Psr\Container\NotFoundExceptionInterface;

class ContainerNotFoundException extends \Exception implements NotFoundExceptionInterface
{
    /**
     * @var ModernPHPException
     */
    private ModernPHPException $exception;

    // Redefine the exception so message isn't optional
    public function __construct($id)
    {
        $this->exception->errorHandler(404, "Dependency \"" . $id . "\" not found", __FILE__, __LINE__);
    }
}
