<?php

namespace App\Exceptions\API;

use App\Exceptions\ErrorCode;

use Symfony\Component\HttpFoundation\Response;

final class UnauthorizedAccessException extends APIException {

    public final function __construct() {

        parent::__construct(
            statusCode: Response::HTTP_UNAUTHORIZED,
            message: 'Unauthorized access',
            code: ErrorCode::UnauthorizedAccess
        );
    }
}
