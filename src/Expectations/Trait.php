<?php

declare(strict_types=1);

use Pest\Arch\Contracts\ArchExpectation;
use Saloon\Traits\Auth\RequiresAuth;
use Saloon\Traits\OAuth2\AuthorizationCodeGrant;
use Saloon\Traits\OAuth2\ClientCredentialsBasicAuthGrant;
use Saloon\Traits\OAuth2\ClientCredentialsGrant;
use Saloon\Traits\Plugins\AcceptsJson;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;
use Saloon\Traits\Plugins\HasApiVersion;
use Saloon\Traits\Plugins\HasTimeout;

expect()->extend(
    'toUseAcceptsJsonTrait',
    fn (): ArchExpectation => $this->toUseTrait(AcceptsJson::class)
);

expect()->extend(
    'toUseAlwaysThrowOnErrorsTrait',
    fn (): ArchExpectation => $this->toUseTrait(AlwaysThrowOnErrors::class)
);

expect()->extend(
    'toUseTimeoutTrait',
    fn (): ArchExpectation => $this->toUseTrait(HasTimeout::class)
);

expect()->extend(
    'toUseAuthorisationCodeGrantTrait',
    fn (): ArchExpectation => $this->toUseTrait(AuthorizationCodeGrant::class)
);

expect()->extend(
    'toUseClientCredentialsGrantTrait',
    fn (): ArchExpectation => $this->toUseTrait(ClientCredentialsGrant::class)
);

expect()->extend(
    'toUseClientCredentialsBasicAuthGrantTrait',
    fn (): ArchExpectation => $this->toUseTrait(ClientCredentialsBasicAuthGrant::class)
);

expect()->extend(
    'toUseRequiresAuthTrait',
    fn (): ArchExpectation => $this->toUseTrait(RequiresAuth::class)
);

expect()->extend(
    'toUseApiVersionTrait',
    fn (): ArchExpectation => $this->toUseTrait(HasApiVersion::class)
);
