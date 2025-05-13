<?php

namespace App\Exceptions\API;

use App\Exceptions\ErrorCode;
use Symfony\Component\HttpFoundation\Response;

final class InvalidCredentialsException extends APIException {
    
    public final function __construct() {

        parent::__construct(
            statusCode: Response::HTTP_BAD_REQUEST,
            message: 'Invalid credentials provided.',
            code: ErrorCode::InvalidCredentials
        );
    }
}
