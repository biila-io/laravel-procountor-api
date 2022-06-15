<?php

namespace BiilaIo\Procountor;

use BiilaIo\Procountor\Exceptions\ProcountorApiException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redis;
use Predis\Response\Status;

class ProcountorAccessToken
{
    protected ProcountorConfig $config;

    protected ?string $accessToken = null;
    protected ?Carbon $expiresIn = null;

    /**
     * The ProcountorAccessToken constructor.
     *
     * @param ProcountorConfig $config
     */
    public function __construct(ProcountorConfig $config)
    {
        $this->config = $config;

        [$this->accessToken, $this->expiresIn] = $this->getStoredToken();
    }

    /**
     * Get the expires in timestamp
     *
     * @return string|null
     */
    public function getExpiresIn(): ?string
    {
        return optional($this->expiresIn)->toIso8601ZuluString();
    }

    /**
     * Get the time left in the expiration.
     *
     * @return int|null
     */
    public function getTtl(): ?int
    {
        return optional($this->expiresIn)->diffInSeconds();
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getToken(): string
    {
        if (!$this->expiresIn || $this->expiresIn->isPast()) {
            $this->refreshToken();
        }

        return $this->accessToken;
    }

    /**
     * Undocumented function
     *
     * @return bool
     */
    public function refreshToken()
    {
        [$this->accessToken, $this->expiresIn] = $this->fetchToken();

        return true;
    }

    /**
     * Fetch a new access token from Procountor and then store it to redis.
     *
     * @return array
     */
    protected function fetchToken(): array
    {
        $response = $this->config->http()->asForm()->post('oauth/token', [
            'grant_type' => 'client_credentials',
            'client_id' => $this->config->client_id,
            'client_secret' => $this->config->client_secret,
            'redirect_uri' => $this->config->redirect_uri,
            'api_key' => $this->config->api_key,
        ]);

        if (!$response->successful()) {
            throw ProcountorApiException::accessTokenFetchFailed($response);
        }

        $this->storeToken(
            $token = $response->json('access_token'),
            $expiresIn = $response->json('expires_in')
        );

        return [$token, Carbon::now()->addSeconds($expiresIn)];
    }

    /**
     * Get stored token from redis.
     *
     * @return array
     */
    protected function getStoredToken(): array
    {
        $token = Redis::get($this->config->storage_key);

        if (!$token) return [null, null];

        $expiresIn = Redis::ttl($this->config->storage_key);

        return [$token, Carbon::now()->addSeconds($expiresIn)];
    }

    /**
     * Store token to redis.
     *
     * @param string $token
     * @param int $expiresIn
     * @return \Predis\Response\Status
     */
    protected function storeToken(string $token, int $expiresIn): Status
    {
        return Redis::set($this->config->storage_key, $token, 'ex', $expiresIn);
    }
}
