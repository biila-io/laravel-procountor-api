<?php

namespace BiilaIo\Procountor\Exceptions;

use RuntimeException;
use Illuminate\Http\Client\Response;

class ProcountorApiException extends RuntimeException
{
    /**
     * Create exception instance for access-token-fetch-failed.
     *
     * @param \Illuminate\Http\Client\Response $response
     * @return void
     */
    public static function accessTokenFetchFailed(Response $response)
    {
        return new static(sprintf(
            "Fetching access token from Procountor failed. '%s'",
            $response->body()
        ));
    }
}