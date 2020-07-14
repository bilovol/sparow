<?php

declare(strict_types=1);

namespace App\Exceptions\Api\SendPulseService;

/**
 * Class RssCreateException
 * @package App\Exceptions\Api\Soa\RssService
 */
class UnauthorizedException extends \Exception
{
    public function __construct($message = 'Failed on authenticate sp user', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
