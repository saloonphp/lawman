<?php

declare(strict_types=1);

namespace Saloon\Lawman\Exceptions;

use RuntimeException;
use Saloon\Contracts\Authenticator;

final class MissingDefaultAuthException extends RuntimeException
{
    /**
     * @param  class-string  $class
     */
    public static function for(string $class): self
    {
        return new self(sprintf(
            '[%s] does not define a defaultAuth() method returning a concrete authenticator; its return type resolves to the generic [%s] contract.',
            $class,
            Authenticator::class,
        ));
    }
}
