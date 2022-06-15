<?php

namespace BiilaIo\Procountor;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Fluent;

class ProcountorConfig
{
    protected Fluent $config;

    public function __construct(array $servicesConfig, array $config)
    {
        $this->config = new Fluent(array_merge($servicesConfig, $config));
    }

    /**
     * Return http instance with basic settings set.
     *
     * @param string|null $accessToken
     * @return \Illuminate\Http\Client\PendingRequest
     */
    public function http(?string $accessToken = null): PendingRequest
    {
        $request = Http::baseUrl($this->base_url);

        if ($accessToken) {
            $request->withToken($accessToken);
        }

        return $request;
    }

    /**
     * Handle dynamic calls to the fluent instance to set attributes.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return $this
     */
    public function __call($method, $parameters)
    {
        return $this->config->__call($method, $parameters);
    }

    /**
     * Dynamically retrieve the value of an attribute.
     *
     * @param  string  $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->config->__get($key);
    }

    /**
     * Dynamically set the value of an attribute.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return void
     */
    public function __set($key, $value)
    {
        return $this->config->__set($key, $value);
    }

    /**
     * Dynamically check if an attribute is set.
     *
     * @param  string  $key
     * @return bool
     */
    public function __isset($key)
    {
        return $this->config->__isset($key);
    }

    /**
     * Dynamically unset an attribute.
     *
     * @param  string  $key
     * @return void
     */
    public function __unset($key)
    {
        return $this->config->__unset($key);
    }
}
