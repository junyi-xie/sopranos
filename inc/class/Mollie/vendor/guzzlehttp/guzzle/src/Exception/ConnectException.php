<?php

namespace _PhpScoper3234cdc49fbb\GuzzleHttp\Exception;

use _PhpScoper3234cdc49fbb\Psr\Http\Message\RequestInterface;
/**
 * Exception thrown when a connection cannot be established.
 *
 * Note that no response is present for a ConnectException
 */
class ConnectException extends \_PhpScoper3234cdc49fbb\GuzzleHttp\Exception\RequestException
{
    public function __construct($message, \_PhpScoper3234cdc49fbb\Psr\Http\Message\RequestInterface $request, \Exception $previous = null, array $handlerContext = [])
    {
        parent::__construct($message, $request, null, $previous, $handlerContext);
    }
    /**
     * @return null
     */
    public function getResponse()
    {
        return null;
    }
    /**
     * @return bool
     */
    public function hasResponse()
    {
        return \false;
    }
}
