<?php

namespace BiilaIo\Procountor;

use Illuminate\Http\Client\PendingRequest;

class Procountor
{
    use Endpoints\Attachments,
        Endpoints\Invoices;

    protected ProcountorConfig $config;
    protected ProcountorAccessToken $accessToken;

    /**
     * The Procountor constructor.
     *
     * @param ProcountorConfig $config
     */
    public function __construct(ProcountorConfig $config)
    {
        $this->config = $config;
        $this->accessToken = new ProcountorAccessToken($this->config);
    }

    /**
     * Get the Procountor config instance.
     *
     * @return ProcountorConfig
     */
    public function getConfig(): ProcountorConfig
    {
        return $this->config;
    }

    /**
     * Get the access token
     *
     * @return string
     */
    public function accessToken()
    {
        return $this->accessToken->getToken();
    }

    /**
     * Get the access token
     *
     * @return string|null
     */
    public function accessTokenExpiresAt(): ?string
    {
        return $this->accessToken->getExpiresIn();
    }

    /**
     * Refresh the access token.
     *
     * @return bool
     */
    public function refreshAccessToken(): bool
    {
        return $this->accessToken->refreshToken();
    }

    /**
     * Return http with authentication set in as default.
     *
     * @param bool $auth
     * @return \Illuminate\Http\Client\PendingRequest
     */
    final protected function http(bool $auth = true): PendingRequest
    {
        return $this->config->http($auth ? $this->accessToken() : null);
    }
}
