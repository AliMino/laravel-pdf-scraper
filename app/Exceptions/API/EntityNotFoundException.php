<?php

namespace App\Exceptions\API;

use App\Exceptions\ErrorCode;
use Symfony\Component\HttpFoundation\Response;

final class EntityNotFoundException extends APIException {
    
    public final function __construct(public readonly ?string $entity = null) {

        parent::__construct(
            statusCode: Response::HTTP_NOT_FOUND,
            message: sprintf('%s not found', $entity ?? 'Entity'),
            code: ErrorCode::EntityNotFound
        );
    }
}
