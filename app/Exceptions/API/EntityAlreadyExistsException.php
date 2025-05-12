<?php

namespace App\Exceptions\API;

use App\Exceptions\ErrorCode;
use Symfony\Component\HttpFoundation\Response;

final class EntityAlreadyExistsException extends APIException {
    
    public final function __construct(
        
        public readonly ?string $entity       = null,
        public readonly ?string $uniqueColumn = null
    ) {

        parent::__construct(
            statusCode: Response::HTTP_CONFLICT,
            message: sprintf('%s %s already in use', $entity ? "$entity's" : '', $uniqueColumn),
            code: ErrorCode::EntityAlreadyExists
        );
    }
}
