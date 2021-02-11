<?php

namespace _PhpScoper3234cdc49fbb\GuzzleHttp\Psr7;

use _PhpScoper3234cdc49fbb\Psr\Http\Message\StreamInterface;
/**
 * Stream decorator that prevents a stream from being seeked
 */
class NoSeekStream implements \_PhpScoper3234cdc49fbb\Psr\Http\Message\StreamInterface
{
    use StreamDecoratorTrait;
    public function seek($offset, $whence = \SEEK_SET)
    {
        throw new \RuntimeException('Cannot seek a NoSeekStream');
    }
    public function isSeekable()
    {
        return \false;
    }
}
