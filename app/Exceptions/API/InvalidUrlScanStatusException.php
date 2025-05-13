<?php

namespace App\Exceptions\API;

use App\Exceptions\ErrorCode;
use Symfony\Component\HttpFoundation\Response;

final class InvalidUrlScanStatusException extends APIException {
    
    public final function __construct() {

        parent::__construct(
            statusCode: Response::HTTP_UNPROCESSABLE_ENTITY,
            message: 'Invalid URL scan status.',
            code: ErrorCode::InvalidUrlScanStatus
        );
    }
}
