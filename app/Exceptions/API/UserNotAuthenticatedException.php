<?php

namespace App\Exceptions\API;

use App\Exceptions\ErrorCode;

use Symfony\Component\HttpFoundation\Response;

final class UserNotAuthenticatedException extends APIException {

    public final function __construct() {

        parent::__construct(
            statusCode: Response::HTTP_UNAUTHORIZED,
            message: 'User not authenticated',
            code: ErrorCode::UserNotAuthenticated
        );
    }
}
