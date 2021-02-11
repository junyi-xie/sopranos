<?php

namespace _PhpScoper3234cdc49fbb\GuzzleHttp\Promise;

final class Is
{
    /**
     * Returns true if a promise is pending.
     *
     * @return bool
     */
    public static function pending(\_PhpScoper3234cdc49fbb\GuzzleHttp\Promise\PromiseInterface $promise)
    {
        return $promise->getState() === \_PhpScoper3234cdc49fbb\GuzzleHttp\Promise\PromiseInterface::PENDING;
    }
    /**
     * Returns true if a promise is fulfilled or rejected.
     *
     * @return bool
     */
    public static function settled(\_PhpScoper3234cdc49fbb\GuzzleHttp\Promise\PromiseInterface $promise)
    {
        return $promise->getState() !== \_PhpScoper3234cdc49fbb\GuzzleHttp\Promise\PromiseInterface::PENDING;
    }
    /**
     * Returns true if a promise is fulfilled.
     *
     * @return bool
     */
    public static function fulfilled(\_PhpScoper3234cdc49fbb\GuzzleHttp\Promise\PromiseInterface $promise)
    {
        return $promise->getState() === \_PhpScoper3234cdc49fbb\GuzzleHttp\Promise\PromiseInterface::FULFILLED;
    }
    /**
     * Returns true if a promise is rejected.
     *
     * @return bool
     */
    public static function rejected(\_PhpScoper3234cdc49fbb\GuzzleHttp\Promise\PromiseInterface $promise)
    {
        return $promise->getState() === \_PhpScoper3234cdc49fbb\GuzzleHttp\Promise\PromiseInterface::REJECTED;
    }
}
