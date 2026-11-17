<?php

declare(strict_types=1);

use Pest\Arch\Contracts\ArchExpectation;
use Pest\Expectation;
use Saloon\Contracts\Authenticator;
use Saloon\Contracts\OAuthAuthenticator;
use Saloon\Http\Auth\AccessTokenAuthenticator;
use Saloon\Http\Auth\BasicAuthenticator;
use Saloon\Http\Auth\CertificateAuthenticator;
use Saloon\Http\Auth\DigestAuthenticator;
use Saloon\Http\Auth\HeaderAuthenticator;
use Saloon\Http\Auth\MultiAuthenticator;
use Saloon\Http\Auth\NullAuthenticator;
use Saloon\Http\Auth\QueryAuthenticator;
use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Lawman\Exceptions\MissingDefaultAuthException;

/**
 * Resolve the authenticator a class declares as the return type of its defaultAuth() method.
 */
function lawmanDefaultAuthenticator(mixed $value): string
{
    $expectationClassName = lawmanExpectationClassName($value);

    $type = (new ReflectionClass($expectationClassName))->getMethod('defaultAuth')->getReturnType();

    if (! $type instanceof ReflectionNamedType) {
        throw new RuntimeException('defaultAuth() must declare a single named return type.');
    }

    $authenticator = $type->getName();

    if ($authenticator === Authenticator::class) {
        throw MissingDefaultAuthException::for($expectationClassName);
    }

    return $authenticator;
}

expect()->extend(
    'toUseTokenAuthentication',
    fn (): Expectation => $this->and(lawmanDefaultAuthenticator($this->value))
        ->toEqual(TokenAuthenticator::class)
);

expect()->extend(
    'toUseBasicAuthentication',
    fn (): Expectation => $this->and(lawmanDefaultAuthenticator($this->value))
        ->toEqual(BasicAuthenticator::class)
);

expect()->extend(
    'toUseCertificateAuthentication',
    fn (): Expectation => $this->and(lawmanDefaultAuthenticator($this->value))
        ->toEqual(CertificateAuthenticator::class)
);

expect()->extend(
    'toUseHeaderAuthentication',
    fn (): Expectation => $this->and(lawmanDefaultAuthenticator($this->value))
        ->toEqual(HeaderAuthenticator::class)
);

expect()->extend(
    'toUseQueryAuthentication',
    fn (): Expectation => $this->and(lawmanDefaultAuthenticator($this->value))
        ->toEqual(QueryAuthenticator::class)
);

expect()->extend(
    'toUseDigestAuthentication',
    fn (): Expectation => $this->and(lawmanDefaultAuthenticator($this->value))
        ->toEqual(DigestAuthenticator::class)
);

expect()->extend(
    'toUseMultipleAuthenticators',
    fn (): Expectation => $this->and(lawmanDefaultAuthenticator($this->value))
        ->toEqual(MultiAuthenticator::class)
);

expect()->extend(
    'toUseAccessTokenAuthentication',
    fn (): Expectation => $this->and(lawmanDefaultAuthenticator($this->value))
        ->toEqual(AccessTokenAuthenticator::class)
);

expect()->extend(
    'toUseNullAuthentication',
    fn (): Expectation => $this->and(lawmanDefaultAuthenticator($this->value))
        ->toEqual(NullAuthenticator::class)
);

expect()->extend(
    'toBeSaloonAuthenticator',
    fn (): ArchExpectation => $this->toImplement(Authenticator::class)
);

expect()->extend(
    'toBeOAuthAuthenticator',
    fn (): ArchExpectation => $this->toImplement(OAuthAuthenticator::class)
);
