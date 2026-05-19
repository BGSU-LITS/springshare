<?php

declare(strict_types=1);

namespace Lits\Springshare\Request;

use Saloon\CachePlugin\Contracts\Cacheable;
use Saloon\CachePlugin\Contracts\Driver;
use Saloon\CachePlugin\Traits\HasCaching;
use Saloon\Enums\Method;
use Saloon\Helpers\OAuth2\OAuthConfig;
use Saloon\Http\OAuth2\GetClientCredentialsTokenRequest as Request;

final class ClientCredentials extends Request implements Cacheable
{
    use HasCaching;

    /** @param array<string> $scopes */
    public function __construct(
        protected Driver $cacheDriver,
        protected OAuthConfig $oauthConfig,
        protected array $scopes = [],
        protected string $scopeSeparator = ' ',
    ) {
        parent::__construct($oauthConfig, $scopes, $scopeSeparator);
    }

    #[\Override]
    public function resolveCacheDriver(): Driver
    {
        return $this->cacheDriver;
    }

    #[\Override]
    public function cacheExpiryInSeconds(): int
    {
        // One day minus 1 minute.
        return (24 * 60 * 60) - 60;
    }

    /** @return array<\Saloon\Enums\Method> */
    protected function getCacheableMethods(): array
    {
        return [Method::POST];
    }
}
