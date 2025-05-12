<?php

namespace App\Exceptions\API;

use App\Exceptions\ErrorCode;
use Symfony\Component\HttpFoundation\Response;

final class InvalidInputsException extends APIException {
    
    public final function __construct(string $message = 'Invalid inputs') {

        parent::__construct(
            statusCode: Response::HTTP_BAD_REQUEST,
            message: $message,
            code: ErrorCode::InvalidInputs
        );
    }
}
