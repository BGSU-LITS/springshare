<?php

declare(strict_types=1);

namespace Lits\Springshare;

use Lits\Springshare\Request\ClientCredentials;
use Psr\Cache\CacheItemPoolInterface as CacheItemPool;
use Psr\SimpleCache\CacheInterface as Cache;
use Saloon\CachePlugin\Contracts\Cacheable;
use Saloon\CachePlugin\Contracts\Driver;
use Saloon\CachePlugin\Drivers\PsrCacheDriver;
use Saloon\CachePlugin\Traits\HasCaching;
use Saloon\Contracts\Authenticator;
use Saloon\Helpers\OAuth2\OAuthConfig;
use Saloon\Http\Auth\NullAuthenticator;
use Saloon\Http\Connector as SaloonConnector;
use Saloon\Http\Request;
use Saloon\Traits\OAuth2\ClientCredentialsGrant;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Psr16Cache;

abstract class Connector extends SaloonConnector implements Cacheable
{
    use ClientCredentialsGrant;
    use HasCaching;

    public Driver $cacheDriver;
    public int $cacheExpiry = 60;
    protected string $version = '1.1';

    public function __construct(
        public string $host,
        public string $clientId,
        public string $clientSecret,
        Cache|CacheItemPool|Driver $cache = new ArrayAdapter(),
    ) {
        if ($cache instanceof CacheItemPool) {
            $cache = new Psr16Cache($cache);
        }

        if ($cache instanceof Cache) {
            $cache = new PsrCacheDriver($cache);
        }

        $this->cacheDriver = $cache;
    }

    #[\Override]
    public function resolveBaseUrl(): string
    {
        return 'https://' . $this->host . '/api/' . $this->version;
    }

    #[\Override]
    public function resolveCacheDriver(): Driver
    {
        return $this->cacheDriver;
    }

    #[\Override]
    public function cacheExpiryInSeconds(): int
    {
        return $this->cacheExpiry;
    }

    #[\Override]
    protected function defaultAuth(): ?Authenticator
    {
        $authenticator = $this
            ->authenticate(new NullAuthenticator())
            ->getAccessToken();

        if ($authenticator instanceof Authenticator) {
            return $authenticator;
        }

        return null;
    }

    protected function defaultOauthConfig(): OAuthConfig
    {
        return OAuthConfig::make()
            ->setClientId($this->clientId)
            ->setClientSecret($this->clientSecret)
            ->setTokenEndpoint('/oauth/token');
    }

    /** @param array<string> $scopes */
    protected function resolveAccessTokenRequest(
        OAuthConfig $oauthConfig,
        array $scopes = [],
        string $scopeSeparator = ' ',
    ): Request {
        return new ClientCredentials(
            $this->resolveCacheDriver(),
            $oauthConfig,
            $scopes,
            $scopeSeparator,
        );
    }
}
