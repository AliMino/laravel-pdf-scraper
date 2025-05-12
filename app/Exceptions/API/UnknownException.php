<?php

namespace App\Exceptions\API;

use App\Exceptions\ErrorCode;
use Symfony\Component\HttpFoundation\Response;

final class UnknownException extends APIException {

    public final function __construct() {

        parent::__construct(
            statusCode: Response::HTTP_INTERNAL_SERVER_ERROR,
            message: 'Unknown error occurred',
            code: ErrorCode::Unknown
        );
    }
}
