<?php

namespace App\Exceptions\API;

use App\Exceptions\ErrorCode;
use Symfony\Component\HttpFoundation\Response;

final class UrlScanInProgressException extends APIException {
    
    public final function __construct() {

        parent::__construct(
            statusCode: Response::HTTP_UNPROCESSABLE_ENTITY,
            message: 'Url scan already in progress for this URL.',
            code: ErrorCode::UrlScanInProgress
        );
    }
}
